<?php

namespace Modules\Chat\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\Chat\Models\ChatMaxSubscriptionEventType;
use Modules\Chat\Models\ChatMaxWeatherSchoolClassRange;
use Modules\Chat\Services\Max\MaxService;
use Modules\Chat\Services\Max\Subscriptions\SubscriptionService;
use Modules\Chat\Swagger\Docs\Attributes\GetMaxWebAppUrl;
use Modules\Chat\Swagger\Docs\Attributes\MaxController\CreateMaxSubscription;
use Modules\Chat\Swagger\Docs\Attributes\MaxController\DeleteMaxSubscription;
use Modules\Chat\Swagger\Docs\Attributes\MaxController\GetSubscriptionSchoolClassRanges;
use Modules\Chat\Swagger\Docs\Attributes\MaxController\GetSubscriptionsEventTypes;
use Modules\Chat\Swagger\Docs\Attributes\MaxController\GetUserMaxSubscriptions;
use Modules\Chat\Swagger\Docs\Attributes\MaxController\SendAppointmentNotificationToMax;
use Modules\RegionHeadHotlineWidget\Models\RegionHeadHotlineWidgetMaxContact;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'MaxController', description: 'Контроллер для работы с Max')]
class MaxController
{
    private MaxService $maxService;
    private SubscriptionService $subscriptionService;

    /**
     * @param MaxService $maxService
     */
    public function __construct(MaxService $maxService)
    {
        $this->maxService = $maxService;
        $this->subscriptionService = new SubscriptionService();
        Context::add('module', 'Chat');
    }

    /**
     * @throws ConnectionException
     */
    public function webhook(Request $request)
    {
        if ($request->get('update_type') === 'bot_stopped') {
            $validated = $request->validate([
                'user.user_id' => 'required|integer',
            ]);
            $this->subscriptionService->deleteAllUserSubscriptions($validated['user']['user_id']);
            return ['success' => true, 'subscriptions_deleted' => true];
        }

        //Log::debug('max webhook', ['request' => $request->all()]);
        if ($request->get('update_type') === 'message_created') {
            $validated = $request->validate([
                'message.recipient.chat_id' => 'required',
                'message.sender' => 'required|array',
                'message.sender.user_id' => 'required|integer',
                'message.sender.first_name' => 'sometimes|string',
                'message.sender.last_name' => 'sometimes',
                'message.sender.name' => 'sometimes',
                'message.body.text' => 'required',
                'update_type' => 'required|string',
            ]);
            $validated['user'] = $validated['message']['sender'];
            $validated['user']['chat_id'] = $validated['message']['recipient']['chat_id'];
        } else {
            $validated = $request->validate([
                'chat_id' => 'required',
                'user' => 'required|array',
                'user.user_id' => 'required|integer',
                'user.first_name' => 'sometimes|string',
                'user.last_name' => 'sometimes',
                'user.name' => 'sometimes',
                'message' => 'sometimes|array',
                'update_type' => 'required|string',
            ]);
            $validated['user']['chat_id'] = $validated['chat_id'];
        }
        return $this->maxService->handleIncomingMessage($validated['user'], $validated['update_type'], $validated['message']['body']['text'] ?? null);
    }

    #[GetMaxWebAppUrl]
    public function getWidgetFromMax(Request $request, string $urlId)
    {
        return $this->maxService->getWidgetFromMax($urlId);
    }

    /**
     * Создание подписки на события для пользователя в Max
     * @param Request $request
     * @return true[]
     */
    #[CreateMaxSubscription]
    public function createSubscription(Request $request)
    {
        $validated = $request->validate([
            'web_app_data' => 'required|array',
            'web_app_data.auth_date' => 'sometimes|integer|nullable',
            'web_app_data.ip' => 'sometimes|string|nullable',

            'web_app_data.chat' => 'sometimes|array',
            'web_app_data.chat.id' => 'sometimes|integer|nullable',
            'web_app_data.chat.type' => 'sometimes|string|nullable',

            'web_app_data.query_id' => 'sometimes|string',

            'web_app_data.user' => 'required|array',
            'web_app_data.user.id' => 'required|integer|nullable',
            'web_app_data.user.first_name' => 'required|string',
            'web_app_data.user.last_name' => 'sometimes|string|nullable',
            'web_app_data.user.language_code' => 'sometimes|string',
            'web_app_data.user.username' => 'sometimes|string|nullable',
            'web_app_data.user.photo_url' => 'sometimes|string|nullable',

            'event_type_id' => 'required|exists:chat_max_subscription_event_types,id',
            'city_id' => 'required|exists:actirovki_widget_cities,id',
            'school_class_range_id' => 'sometimes|exists:chat_max_weather_school_class_ranges,id',
            'school_shift' => 'sometimes|integer:1,2',
        ]);

        return $this->subscriptionService->createSubscription(
            $validated['web_app_data']['chat']['id'] ?? null,
            $validated['web_app_data']['user']['id'],
            $validated['event_type_id'],
            $validated['city_id'],
            $validated['school_class_range_id'] ?? null,
            $validated['school_shift'] ?? null
        );
    }

    /**
     * Удаление подписки на события для пользователя в Max
     * @param Request $request
     * @return true[]
     */
    #[DeleteMaxSubscription]
    public function deleteSubscription(Request $request)
    {
        $validated = $request->validate([
            'web_app_data' => 'required|array',
            'web_app_data.auth_date' => 'sometimes|integer|nullable',
            'web_app_data.ip' => 'sometimes|string|nullable',

            'web_app_data.chat' => 'sometimes|array',
            'web_app_data.chat.id' => 'sometimes|integer|nullable',
            'web_app_data.chat.type' => 'sometimes|string|nullable',

            'web_app_data.query_id' => 'sometimes|string',

            'web_app_data.user' => 'required|array',
            'web_app_data.user.id' => 'required|integer|nullable',
            'web_app_data.user.first_name' => 'required|string',
            'web_app_data.user.last_name' => 'sometimes|string|nullable',
            'web_app_data.user.language_code' => 'sometimes|string',
            'web_app_data.user.username' => 'sometimes|string|nullable',
            'web_app_data.user.photo_url' => 'sometimes|string|nullable',

            'subscription_id' => 'required|exists:chat_max_user_subscriptions,id',
        ]);

        $userId = $validated['web_app_data']['user']['id'];

        return $this->subscriptionService->deleteSubscription($validated['subscription_id'], $userId);
    }

    /**
     * Получение всех подписок пользователя в Max
     * @param Request $request
     * @return Collection
     */
    #[GetUserMaxSubscriptions]
    public function getUserSubscriptions(Request $request)
    {
        $validated = $request->validate([
            'web_app_data' => 'required|array',
            'web_app_data.auth_date' => 'sometimes|integer|nullable',
            'web_app_data.ip' => 'sometimes|string|nullable',

            'web_app_data.chat' => 'sometimes|array',
            'web_app_data.chat.id' => 'sometimes|integer|nullable',
            'web_app_data.chat.type' => 'sometimes|string|nullable',

            'web_app_data.query_id' => 'sometimes|string',

            'web_app_data.user' => 'required|array',
            'web_app_data.user.id' => 'required|integer|nullable',
            'web_app_data.user.first_name' => 'required|string',
            'web_app_data.user.last_name' => 'sometimes|string|nullable',
            'web_app_data.user.language_code' => 'sometimes|string',
            'web_app_data.user.username' => 'sometimes|string|nullable',
            'web_app_data.user.photo_url' => 'sometimes|string|nullable',

            'event_type_id' => 'sometimes|exists:chat_max_subscription_event_types,id',
            'city_id' => 'sometimes|exists:actirovki_widget_cities,id',
        ]);

        $userId = $validated['web_app_data']['user']['id'];

        return $this->subscriptionService->getUserSubscriptions(
            $userId,
            $validated['event_type_id'] ?? null,
            $validated['city_id'] ?? null,
        );
    }

    /**
     * Отправка уведомления пользователю Max, у которых есть подписка на определенное событие
     * @param Request $request
     * @return true[]
     * @throws ConnectionException
     */
    #[SendAppointmentNotificationToMax]
    public function sendAppointmentNotificationToMax(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required',
            'message' => 'required',
        ]);

        return $this->subscriptionService->sendAppointmentNotificationToMax($validated['phone'], $validated['message']);
    }

    /**
     * Получение всех типов событий, на которые можно подписаться в Max
     * @param Request $request
     * @return Collection
     */
    #[GetSubscriptionsEventTypes]
    public function getSubscriptionEventTypes(Request $request)
    {
        return ChatMaxSubscriptionEventType::all();
    }

    /**
     * Получение всех диапазонов классов школы для подписки на погоду
     * @param Request $request
     * @return Collection
     */
    #[GetSubscriptionSchoolClassRanges]
    public function getSubscriptionSchoolClassRanges(Request $request)
    {
        return ChatMaxWeatherSchoolClassRange::all();
    }
}
