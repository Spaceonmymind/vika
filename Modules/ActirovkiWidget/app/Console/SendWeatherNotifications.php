<?php

namespace Modules\ActirovkiWidget\Console;

use Illuminate\Database\Eloquent\Builder;
use Modules\ActirovkiWidget\Helpers\AktovkaMessageFormatter;
use Modules\ActirovkiWidget\Helpers\ModuleLog;
use Modules\ActirovkiWidget\Jobs\SendWeatherToAdmhmansy;
use Modules\ActirovkiWidget\Jobs\SendWeatherToMaxUsers;
use Modules\ActirovkiWidget\Jobs\SendWeatherToUgraApp;
use Modules\ActirovkiWidget\Models\City;
use Modules\Chat\Models\ChatMaxUserSubscription;
use Modules\Chat\Models\ChatMaxWeatherSubscription;

class SendWeatherNotifications extends Command
{
    protected $signature = 'weather:send_notifications
     {--school_shift= : Смена в школе (1 или 2)}';
    protected $description = 'Отправить уведомления об актироваках в три системы: UgraApp, Администрация ХМАО и Макс';


    // Размер пачки пользователей при порционной обработке
    private int $usersChunkSize;

    public function handle(): void
    {
        $schoolShift = (int)$this->option('school_shift');

        if ($schoolShift !== 1 && $schoolShift !== 2) {
            $this->error('Аргумент school_shift должен быть равен 1 или 2');
            return;
        }

        $this->usersChunkSize = config('services.actirovki.users_chunk_size');

        SendWeatherToUgraApp::dispatch($schoolShift)->onQueue('actirovki');
        SendWeatherToAdmhmansy::dispatch($schoolShift)->onQueue('actirovki');
        $this->sendNotificationToUsers($schoolShift);
    }

    private function sendNotificationToUsers(int $schoolShift): void
    {
        // Берём города, у которых есть актировка сегодня и она относится к текущей смене
        $cities = City::query()
            ->with([
                'latestActirovkiWidgetRow.weather',
                'latestActirovkiWidgetRow.weather_range'
            ])
            ->whereHas('latestActirovkiWidgetRow', function ($q) use ($schoolShift) {
                $q->where('school_shift', $schoolShift);
            })
            ->get();

        $counter = 0;
        /** @var City $city */
        foreach ($cities as $city) {
            $row = $city->latestActirovkiWidgetRow;
            $targetSchoolClass = $row->weather_range->school_class;
            // Если в строке актировки смена не указана — считаем, что она относится к текущей смене.
            $targetSchoolShift = $row->school_shift;

            $message = AktovkaMessageFormatter::announcedWithTempAndWind(
                $targetSchoolShift,
                $row->created_at,
                $city->name,
                $row->weather->temperature ?? null,
                $row->weather->wind ?? null,
                $targetSchoolClass,
            );

            // Обрабатываем пользователей по городу порциями, чтобы не загружать в память всех подписчиков сразу.
            ChatMaxUserSubscription::query()
                ->select('user_id')
                ->whereHas('event_type', function ($q) {
                    $q->where('code', 'actirovki');
                })
                ->whereHas('weather_subscription', function (Builder $q) use ($city) {
                    $q->where('city_id', $city->getKey());
                })
                ->distinct()
                ->chunk($this->usersChunkSize, function ($userRows) use (&$counter, $message, $targetSchoolClass, $targetSchoolShift, $city) {
                    $userIds = $userRows->pluck('user_id');

                    $subscriptions = ChatMaxUserSubscription::query()
                        ->with(['weather_subscription.school_class_range'])
                        ->whereIn('user_id', $userIds)
                        ->whereHas('event_type', function ($q) {
                            $q->where('code', 'actirovki');
                        })
                        ->whereHas('weather_subscription', function (Builder $q) use ($city) {
                            $q->where('city_id', $city->getKey());
                        })
                        ->get()
                        ->groupBy('user_id');

                    // Обрабатываем каждого пользователя из пачки — гарантированно ровно один проход на user_id
                    foreach ($userIds as $userId) {
                        if (!isset($subscriptions[$userId])) {
                            continue;
                        }
                        $userSubscriptions = $subscriptions[$userId];

                        // Отфильтруем подписки, которые действительно должны получить уведомление
                        $applicable = $userSubscriptions->filter(function (ChatMaxUserSubscription $u) use ($targetSchoolClass, $targetSchoolShift) {
                            return $this->isShouldNotify($u->weather_subscription, $targetSchoolClass, $targetSchoolShift);
                        });

                        if ($applicable->isEmpty()) {
                            continue;
                        }

                        // Выбираем подписку с наибольшим max_class (если нет диапазона — минимальное значение)
                        $chosen = $applicable->sortByDesc(function (ChatMaxUserSubscription $s) {
                            $range = $s->weather_subscription->school_class_range ?? null;

                            return $range ? $range->max_class : PHP_INT_MIN;
                        })->first();

                        if ($chosen === null) {
                            continue;
                        }

                        SendWeatherToMaxUsers::dispatch($chosen->user_id, $message)->onQueue('actirovki');
                        $counter++;
                    }
                });
        }

        ModuleLog::moduleAndTelegram()->info('Отправка уведомлений об актировках пользователям Макс выполнена. Количество отправленных сообщений: ' . $counter);
    }

    /**
     * Determine whether given weather subscription should receive notification for an actirovka row.
     */
    private function isShouldNotify(ChatMaxWeatherSubscription $weatherSubscription, ?int $targetSchoolClass, int $targetSchoolShift): bool
    {
        $range = $weatherSubscription->school_class_range;
        if ($range === null) {
            return false;
        }

        if ($targetSchoolClass === null) {
            return false;
        }

        // Если максимальный класс подписки меньше целевого класса — подписка не покрывает этот уровень
        if ($range->max_class < $targetSchoolClass) {
            return false;
        }

        // если подписка не указывает смену — получать всегда, иначе только при совпадении
        if ($weatherSubscription->school_shift === null) {
            return true;
        }

        return $weatherSubscription->school_shift === $targetSchoolShift;
    }
}
