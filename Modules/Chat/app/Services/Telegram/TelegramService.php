<?php

namespace Modules\Chat\Services\Telegram;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class TelegramService
{
    private string $token;
    private string $baseUrl;

    public function __construct()
    {
        $this->token = config('services.telegram.token');
        $this->baseUrl = "https://api.telegram.org/bot$this->token";
    }

    /**
     * @throws ConnectionException
     */
    public function sendOrEditMessage(int $chatId, ?int $messageId, TelegramBuilder $builder): void
    {
        if ($messageId) {
            $this->editMessage($chatId, $messageId, $builder);
        } else {
            $this->sendMessage($chatId, $builder);
        }
    }

    /**
     * Отправить сообщение в чат
     * @param int $chatId
     * @param TelegramBuilder $builder
     * @return void
     * @throws ConnectionException
     */
    public function sendMessage(int $chatId, TelegramBuilder $builder): void
    {
        $message = $builder->get();

        $this->callTelegramApi('sendMessage', array_merge(['chat_id' => $chatId], $message));
    }

    /**
     * Отредактировать прошлое сообщение
     * @param int $chatId
     * @param int $messageId
     * @param TelegramBuilder $builder
     * @return void
     * @throws ConnectionException
     */
    public function editMessage(int $chatId, int $messageId, TelegramBuilder $builder): void
    {
        $message = $builder->get();

        $this->callTelegramApi(
            'editMessageText',
            array_merge(['chat_id' => $chatId, 'message_id' => $messageId], $message));
    }

    /**
     * @throws ConnectionException
     */
    private function callTelegramApi(string $method, array $params): void
    {
        $url = $this->baseUrl . '/' . $method;

        $resp = Http::post($url, $params)->json();
//        Log::debug('ответ телеги', [$resp]);
//        return $resp;
    }

    public function isAdmin(int $chatId): bool
    {
        $adminsIdsArray = explode(',', config('services.telegram.admins_ids'));
        return in_array($chatId, $adminsIdsArray);
    }
}
