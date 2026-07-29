<?php

namespace Modules\Chat\Services\Telegram;

use Modules\Chat\Jobs\SendResponseForTelegram;
use Modules\Chat\Models\ChatTelegramMessage;

class DialogFlow
{
    private TelegramService $telegram;
    private TelegramBuilder $builder;
//    private int $itemsPerPage = 8;
//    private string $mainEmojiBack = '🔙';
//    private string $pagesEmojiPrevious = '⬅';
//    private string $pagesEmojiNext = '➡';

    public function __construct(TelegramService $telegram, TelegramBuilder $builder)
    {
        $this->telegram = $telegram;
        $this->builder = $builder;
    }

    public function handleMessage(string $text, int $chatId, int $messageId = null, array $userInfo = []): void
    {
        $messageModel = ChatTelegramMessage::query()
            ->create([
                'chat_id' => $chatId,
                'message' => $text,
                'username' => $userInfo['username'],
                'first_name' => $userInfo['first_name'],
                'last_name' => $userInfo['last_name'],
                'vika_type_id' => 1,
            ]);

        $this->sentMessageFromIntent($messageModel);
    }

    /**
     * Обработка входящего сообщения в очереди
     * @param ChatTelegramMessage $messageModel
     * @return void
     */
    private function sentMessageFromIntent(ChatTelegramMessage $messageModel): void
    {
        SendResponseForTelegram::dispatch($messageModel, $this->telegram, $this->builder)->onQueue('incoming-tg-chat-messages-process');
    }

}
