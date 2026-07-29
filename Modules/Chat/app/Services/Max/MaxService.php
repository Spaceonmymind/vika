<?php

namespace Modules\Chat\Services\Max;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\Chat\Jobs\SendResponseForMax;
use Modules\Chat\Models\ChatMaxMessage;
use Modules\Chat\Models\ChatMaxWebAppUrl;
use Modules\RegionHeadHotlineWidget\Models\RegionHeadHotlineWidgetMaxContact;

class MaxService
{
    /**
     * Обработчик входящих сообщений из MAX
     * @param array $user
     * @param string $update_type
     * @param string|null $message
     * @return true[]
     * @throws ConnectionException
     */
    public function handleIncomingMessage(array $user, string $update_type, ?string $message = null): array
    {
        if ($update_type === 'bot_started') {
            $message = '/start';

            RegionHeadHotlineWidgetMaxContact::query()
                ->where('user_id', $user['user_id'])
                ->update(['active' => true]);

        }

        $maxMessage = ChatMaxMessage::query()->create([
            'chat_id' => $user['chat_id'],
            'user_id' => $user['user_id'],
            'username' => $user['name'] ?? null,
            'first_name' => $user['first_name'] ?? null,
            'last_name' => $user['last_name'] ?? null,
            'message' => $message,
        ]);

        SendResponseForMax::dispatch($maxMessage)->onQueue('incoming-max-chat-messages-process');

        $this->sendActionToChat(
            $user['chat_id'],
            'typing_on',
        );

        return ['success' => true];
    }

    /**
     * Пометить в чате, что бот печатает или выполняет другое действие
     * @param $chatId
     * @param string $action
     * @return void
     * @throws ConnectionException
     */
    public function sendActionToChat($chatId, string $action = 'typing_on'): void
    {
        $response = Http::withoutVerifying()
            ->withUrlParameters([
                'chat_id' => $chatId,
            ])
            ->withToken(config('services.max.token'),'')
            ->post(config('services.max.bot_api_base_url').'/chats/{chat_id}/actions', [
                'action' => $action,
            ]);
    }

    /**
     * Отправка сообщения в MAX (обязателен chat_id или user_id)
     * @param int|null $chatId
     * @param array $message
     * @param int|null $userId
     * @return void
     * @throws ConnectionException
     */
    public function sendMessage(?int $chatId, array $message, ?int $userId = null): void
    {
        $params = [];

        if ($chatId) {
            $params['chat_id'] = $chatId;
        } elseif ($userId) {
            $params['user_id'] = $userId;
        }

        $response = Http::withoutVerifying()
            ->withToken(config('services.max.token'),'')
            ->withQueryParameters($params)
            ->post(config('services.max.bot_api_base_url').'/messages', $message);
        //Log::debug('max send message response', ['message'=>$message,'response' => $response->body(), 'status' => $response->status()]);
    }

    /**
     * Получение информации о виджете по параметру из MAX
     * @param string|int $maxWebAppUrlId
     * @return ChatMaxWebAppUrl
     */
    public function getWidgetFromMax(string|int $maxWebAppUrlId): ChatMaxWebAppUrl
    {
        $maxWebAppUrl = ChatMaxWebAppUrl::query()
            ->when(is_numeric($maxWebAppUrlId), function ($q) use ($maxWebAppUrlId) {
                $q
                    ->where('id', $maxWebAppUrlId)
                    ->whereNull('guid');
            }, function ($q) use ($maxWebAppUrlId) {
                $q->where('guid', $maxWebAppUrlId);
            })
            ->firstOrFail();
        $maxWebAppUrl->load(['chat_widget']);
        return $maxWebAppUrl;
    }
}
