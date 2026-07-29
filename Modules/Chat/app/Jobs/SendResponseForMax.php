<?php

namespace Modules\Chat\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Log;
use Modules\Chat\Helpers\IntentQualifier;
use Modules\Chat\Models\ChatIntent;
use Modules\Chat\Models\ChatMaxMessage;
use Modules\Chat\Models\ChatMaxWebAppUrl;
use Modules\Chat\Services\Max\MaxMessageBuilder;
use Modules\Chat\Services\Max\MaxService;

class SendResponseForMax implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private const VIKA_TYPE = 'main';
    private ChatMaxMessage $chatMessage;
    private MaxService $max;
    private MaxMessageBuilder $builder;

    /**
     * Create a new job instance.
     */
    public function __construct(
        ChatMaxMessage $chatMessage,
    )
    {
        $this->chatMessage = $chatMessage;
        $this->max = new MaxService();
        $this->builder = new MaxMessageBuilder();
        Context::add('vika_type_id', 1);
        Context::add('message', $chatMessage->message);
        Context::add('chat_id', $chatMessage->chat_id);
        Context::add('from_max', true);
    }

    /**
     * Execute the job.
     * @throws ConnectionException
     */
    public function handle(): void
    {

        $intentWithEntities = $this->getIntentByMessage(
            $this->chatMessage->message,
        );

        $answer = $this->getResponseObjectByIntentAndEntities(
            $intentWithEntities['intent'],
            $intentWithEntities['entities'],
            $this->chatMessage->message,
        );

        $answer = $this->convertAnswerToMax($answer)->get();

        if ($intentWithEntities['intent'] === 'welcome') {
            $answer['text'] .= "\n" . 'Очень часто у меня спрашивают:';
        }

        $this->chatMessage->update([
            'answer' => $answer,
        ]);

        $chatId = $this->chatMessage->chat_id;
        //Пока сообщения не редактируются, а просто выводятся новые. Может когда-то пригодится
//        $messageId = $this->chatMessage->id;

        $this->max->sendMessage($chatId, $answer);
    }

    /**
     * @throws ConnectionException
     */
    private function getIntentByMessage(string $message, string $vikaType = 'main'): array
    {
        return IntentQualifier::getIntentWithEntities($message, $vikaType);

    }

    private function getResponseObjectByIntentAndEntities(string $intent, array $entities, ?string $message = null): array
    {
        $intentModel = ChatIntent::query()
            ->where('code', $intent)
            ->first();

        if (!$intentModel instanceof ChatIntent) {

            Log::channel('chat')->warning('Был определён интент, который еще не был добавлен в базу данных', [
                'vika_type' => self::VIKA_TYPE,
                'intent' => $intent,
            ]);

            $intentModel = ChatIntent::query()->where('code', 'input.unknown');
        }
        return $intentModel
            ->handler
            ->class::getResponseDataByIntent($intentModel->code, self::VIKA_TYPE, $entities, $message);
    }

    /**
     * Преобразует данные в ответ для Телеграма
     * @param array $answer
     * @return MaxMessageBuilder
     */
    private function convertAnswerToMax(array $answer): MaxMessageBuilder
    {
        $builder = $this->builder;
        if (isset($answer['text'])) {
            $builder->setText($this->prepareMessageTextToTelegram($answer['text']));
        }

        if (isset($answer['buttons'])) {
            $this->addButtonsToBuilder($builder, $answer['buttons']);
        }

        $webAppUrlAllWidgets = ChatMaxWebAppUrl::query()->create([
            'params' => [
                'chat_id' => $this->chatMessage->chat_id,
                'from_max' => true,
            ],
        ]);

        $builder->addWebAppButton('Посмотреть все виджеты', (string)$webAppUrlAllWidgets->guid);
//        Log::debug('TG BOT_________', $builder->get());
        return $builder;
    }

    /**
     * Подготавливает текст сообщения для отправки в Телеграм
     * @param string $text
     * @return string
     */
    private function prepareMessageTextToTelegram(string $text): string
    {
        $text = mb_ereg_replace('<br>\n', "\n", $text);
        $text = mb_ereg_replace('<br>', "\n", $text);
        return $text;
    }

    private function addButtonsToBuilder(MaxMessageBuilder $builder, array $buttons): void
    {
        foreach ($buttons as $button) {
            if ($button['type'] === 'link') {
                $builder->addLinkButton($button['text'], url: $button['url']);
            }
            //WebApp
            if ($button['type'] === 'widget') {

                $button['params'] = $button['params'] ?? [];
                $button['params']['chat_id'] = $this->chatMessage->chat_id;
                $button['params']['from_max'] = true;

                $webAppUrl = ChatMaxWebAppUrl::query()->create([
                    'widget_id' => $button['widget_id'],
                    'params' => $button['params'],
                ]);

                $builder->addWebAppButton(
                    $button['text'],
                    (string)$webAppUrl->guid
                );
            }
        }
    }
}
