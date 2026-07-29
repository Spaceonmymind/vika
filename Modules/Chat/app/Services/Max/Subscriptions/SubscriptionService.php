<?php

namespace Modules\Chat\Services\Max\Subscriptions;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Log;
use Modules\AppointmentToDoctorWidget\Models\AppointmentToDoctorMaxContact;
use Modules\Chat\Models\ChatMaxUserSubscription;
use Modules\Chat\Models\ChatMaxWeatherSubscription;
use Modules\Chat\Services\Max\MaxMessageBuilder;
use Modules\Chat\Services\Max\MaxService;
use Modules\RegionHeadHotlineWidget\Models\RegionHeadHotlineWidgetMaxContact;

class SubscriptionService
{
    private MaxService $maxService;

    public function __construct()
    {
        $this->maxService = new MaxService();
    }

    /**
     * @throws ConnectionException
     */
    public function sendNotificationToMax(string $message, int $userId): true
    {
        $maxBuilder = new MaxMessageBuilder();
        $maxBuilder->setText($message);

        $this->maxService->sendMessage(null, $maxBuilder->get(), $userId);

        return true;
    }

    /**
     * @throws ConnectionException
     */
    public function sendAppointmentNotificationToMax(string $phone, string $message): array
    {
        $userId = AppointmentToDoctorMaxContact::query()
            ->where('phone', $phone)
            ->value('user_id');

        //TODO: Убрать лог после отладки
        Log::debug('sendNotificationToMax', ['phone' => $phone, 'message' => $message, 'user_id' => $userId]);

        if ($userId === null) {
            return ['success' => true, 'is_message_sent' => false];
        }
        $this->sendNotificationToMax($message, $userId);

        return ['success' => true, 'is_message_sent' => true];
    }

    public function createSubscription(
        ?int $chatId,
        int  $userId,
        int  $eventTypeId,
        int  $cityId,
        int  $schoolClassRangeId,
        int  $schoolShift,
    ): array
    {
        $weatherSub = ChatMaxWeatherSubscription::query()
            ->create([
                'city_id' => $cityId,
                'school_class_range_id' => $schoolClassRangeId,
                'school_shift' => $schoolShift,
            ]);

        $weatherSub->user_subscriptions()->createOrFirst([
            'chat_id' => $chatId,
            'user_id' => $userId,
            'event_type_id' => $eventTypeId,
        ]);

        return ['success' => true];
    }

    /**
     * Удалить подписку пользователя в Max по id подписки
     * @param int $subscriptionId
     * @param $userId
     * @return true[]
     */
    public function deleteSubscription(int $subscriptionId, $userId): array
    {
        ChatMaxUserSubscription::query()
            ->where('id', $subscriptionId)
            ->where('user_id', $userId)
            ->delete();

        return ['success' => true];
    }

    /**
     * Удалить все подписки пользователя в Max (используется при остановке бота пользователем)
     * @param int $userId
     * @return true[]
     */
    public function deleteAllUserSubscriptions(int $userId): array
    {
        //Удалить подписки на актировки
        ChatMaxUserSubscription::query()
            ->where('user_id', $userId)
            ->get()
            ->each
            ->forceDelete();

        //Удалить контакты для записи к врачу
        AppointmentToDoctorMaxContact::query()
            ->where('user_id', $userId)
            ->delete();
        RegionHeadHotlineWidgetMaxContact::query()
            ->where('user_id', $userId)
            ->update(['active' => false]);
        return ['success' => true];
    }


    /**
     * Удалить подписку на события для пользователя в Max без учета SoftDelete
     * @param $userId
     * @param $id
     * @return void
     */
    public function forceDeleteSubscription($userId, $id): void
    {
        ChatMaxUserSubscription::query()
            ->where('id', $id)
            ->where('user_id', $userId)
            ->get()
            ->each
            ->forceDelete();
    }

    public function getUserSubscriptions(int $userId, ?int $event_type_id, ?int $city_id): Collection
    {
        return ChatMaxUserSubscription::query()
            ->with([
                    'event_type',
                    'weather_subscription' => function ($q) {
                        $q->with(['school_class_range', 'city']);
                    }
                ]
            )
            ->where('user_id', $userId)
            ->when(isset($event_type_id), function ($query) use ($event_type_id) {
                $query->where('event_type_id', $event_type_id);
            })
            ->when(isset($city_id), function ($query) use ($city_id) {
                $query->whereHas('weather_subscription', function ($q) use ($city_id) {
                    $q->where('city_id', $city_id);
                });
            })
            ->get();
    }
}
