<?php

namespace Modules\ActirovkiWidget\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Modules\ActirovkiWidget\Helpers\AktovkaMessageFormatter;
use Modules\ActirovkiWidget\Helpers\ModuleLog;
use Modules\ActirovkiWidget\Models\City;
use Modules\ActirovkiWidget\Models\Row;
use RuntimeException;

class SendWeatherToUgraApp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $url;

    private int $schoolShift;

    /**
     * Количество попыток выполнения джобы
     *
     * @var int
     */
    public int $tries = 30;

    /**
     * Секунды до ретрая
     *
     * @var int
     */
    protected int $backoff = 150;

    protected array $schoolShiftsPublicAccess = [
        1 => '06:00', // Время объявления актировки для первой смены
        2 => '11:40', // Время объявления актировки для второй смены
    ];

    /**
     * Create a new job instance.
     */
    public function __construct(int $schoolShift)
    {
        $this->schoolShift = $schoolShift;
        $this->url = config('services.gosuslugi86.weather_mobile_app_api_url');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $currentShift = $this->schoolShift;
        // Берём города, у которых есть актировка сегодня и она относится к текущей смене
        /** @var Collection<int, City> $cities */
        $cities = City::with([
            'latestActirovkiWidgetRow.weather',
            'latestActirovkiWidgetRow.weather_range'
        ])
            ->get();

        $data = [];

        $sentRowIds = [];
        foreach ($cities as $city) {
            $row = $city->latestActirovkiWidgetRow;
            //Отсеять актировки другой смены
            if ($row !== null && $row->school_shift !== $currentShift) {
                $row = null;
            }

            /** @var Row|null $row */
            if ($row !== null) {
                $message = AktovkaMessageFormatter::announcedWithTempAndWind(
                    $row->school_shift ?? null,
                    $row->created_at,
                    $city->name,
                    $row->weather->temperature ?? null,
                    $row->weather->wind ?? null,
                    $row->weather_range->school_class ?? null,
                );

                $createdAt = $row->created_at->format('d.m.Y H:i:s');
                $classesAreCanceled = $row->cancel_at === null ? 1 : 0;

                $sentRowIds[] = $row->id;
            } else {
                $message = AktovkaMessageFormatter::notAnnounced(
                    $this->schoolShift,
                    now(),
                    $this->schoolShiftsPublicAccess[$this->schoolShift]
                );
                $createdAt = now()->format('d.m.Y H:i:s');
                $classesAreCanceled = 0;
            }
            $data[] = [
                'cityId' => $city->fias_id,
                'shift' => $this->schoolShift,
                'createdAt' => $createdAt,
                'message' => $message,
                'classesAreCanceled' => $classesAreCanceled,
            ];
        }

        ModuleLog::module()->info('Отправляемые данные на gosuslugi86 ', $data);

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
                ->timeout(30)
                ->withoutVerifying()
                ->post($this->url, $data);
        } catch (\Throwable $e) {
            ModuleLog::module()->error('Ошибка при отправке данных об актировке на gosuslugi86',
                [
                    'url' => $this->url,
                    'data' => json_encode($data, JSON_UNESCAPED_UNICODE),
                    'error' => $e->getMessage(),
                ]);
            ModuleLog::telegram()->error('Ошибка при отправке данных об актировке на gosuslugi86',
                [
                    'url' => $this->url,
                    'error' => $e->getMessage(),
                ]);

            throw $e;
        }

        if ($response->created()) {
            ModuleLog::moduleAndTelegram()->info('Успешно оправлено сообщение об актировках на gosuslugi86',
                [
                    'response' => htmlspecialchars($response, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'),
                    'status_code' => $response->status(),
                    'class' => __CLASS__
                ]);

            // Обновляем время отправки для успешно отправленных актировок в приложение ГУ Югра (возможно стоит переименовать поле send_at на что-то более понятное)
            if (!empty($sentRowIds)) {
                Row::query()->whereIn('id', $sentRowIds)->update(['send_at' => now()]);
            }

            return;
        }

        ModuleLog::moduleAndTelegram()->error('Ошибка при отправке данных об актировке на gosuslugi86',
            [
                'response' => htmlspecialchars($response, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'),
                'status_code' => $response->status(),
                'class' => __CLASS__
            ]);

        throw new RuntimeException('Не удалось отправить данные об актировке в gosuslugi86');
    }
}
