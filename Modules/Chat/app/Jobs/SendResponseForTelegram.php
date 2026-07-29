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
use Illuminate\Support\Facades\URL;
use Modules\Chat\Helpers\IntentQualifier;
use Modules\Chat\Models\ChatIntent;
use Modules\Chat\Models\ChatTelegramMessage;
use Modules\Chat\Services\Telegram\TelegramBuilder;
use Modules\Chat\Services\Telegram\TelegramService;

class SendResponseForTelegram implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private ChatTelegramMessage $chatMessage;
    private TelegramService $telegram;
    private TelegramBuilder $builder;

    private string $urlToWidgetsList;

    /**
     * Create a new job instance.
     */
    public function __construct(
        ChatTelegramMessage $chatMessage,
        TelegramService     $telegram,
        TelegramBuilder     $builder,
    )
    {
        $this->chatMessage = $chatMessage;
        $this->telegram = $telegram;
        $this->builder = $builder;
        Context::add('vika_type_id', 1);
        Context::add('message', $chatMessage->message);
        Context::add('chat_id', $chatMessage->chat_id);
        Context::add('from_tg', true);

        $this->urlToWidgetsList = config('app.env') === 'local'
            ? 'https://vi.stage.ugraphic.ru/vika/widget?from_tg=true'
            : URL::to('/vika/widget?from_tg=true');
    }

    /**
     * Execute the job.
     * @throws ConnectionException
     */
    public function handle(): void
    {
        $this->chatMessage->load(['vika_type:id,name']);

        $intentWithEntities = $this->getIntentByMessage(
            $this->chatMessage->message,
            $this->chatMessage->vika_type->name,
        );

        $answer = $this->getResponseObjectByIntentAndEntities(
            $intentWithEntities['intent'],
            $intentWithEntities['entities'],
            $this->chatMessage->message,
        );

        $builder = $this->convertAnswerToTelegram($answer);
        if($intentWithEntities['intent']=='welcome'){
            $builder->setText($builder->get()['text'].'Так же меня можно найти в Max : <a href="https://max.ru/ugra_vika_bot">https://max.ru/ugra_vika_bot</a>'."\n\n".'Очень часто у меня спрашивают:'."\n");
        }
        $this->chatMessage->update([
            'answer' => $builder->get(),
        ]);

        $chatId = $this->chatMessage->chat_id;
        //Пока сообщения не редактируются, а просто выводятся новые. Может когда-то пригодится
//        $messageId = $this->chatMessage->id;

        $this->telegram->sendOrEditMessage($chatId, null, $builder);
    }

    /**
     * Преобразует данные в ответ для Телеграма
     * @param array $answer
     * @return TelegramBuilder
     */
    private function convertAnswerToTelegram(array $answer): TelegramBuilder
    {
        $builder = $this->builder;
        if (isset($answer['text'])) {
            $builder->setText($this->prepareMessageTextToTelegram($answer['text']));
        }

        if (isset($answer['buttons'])) {
            $this->addButtonsToBuilder($builder, $answer['buttons']);
        }


        $builder->addButton('Посмотреть все виджеты', web_app_url: $this->urlToWidgetsList);
//        Log::debug('TG BOT_________', $builder->get());
        return $builder;
    }

    private function addButtonsToBuilder(TelegramBuilder $builder, array $buttons): void
    {
        foreach ($buttons as $button) {
            if ($button['type'] === 'link') {
                $builder->addButton($button['text'], url: $button['url']);
            }
            //WebApp
            if ($button['type'] === 'widget') {
                $queryParams = !empty($button['params']) ? '?' . http_build_query($button['params']) : '';
                $queryParams=preg_replace('/%5B[0-9]+%5D/simU', '%5B%5D', $queryParams);
                $extraParams = ($queryParams === '' ? '?' : '&') . 'from_tg=true&chat_id=' . $this->chatMessage->chat_id;
                $builder->addButton(
                    $button['text'],
                    web_app_url: $button['widget_url'] . $queryParams . $extraParams);
            }
        }
    }

    /**
     * @throws ConnectionException
     */
    private function getIntentByMessage(string $message, string $vikaType = 'main'): array
    {
        if (config('services.intent_qualifiers.tolya.base_url') !== null) {
            return IntentQualifier::getIntentWithEntities($message, $vikaType);
        }

        return [
            'intent' => 'benz',
            'entities' => [
                [
                    'type' => 'fuel_type',
                    'value' => 'ai_92',
                    'start' => 2,
                    'end' => 13,
                ],
                [
                    'type' => 'fuel_type',
                    'value' => 'ai_98',
                    'start' => 15,
                    'end' => 20,
                ],
                [
                    'type' => 'city',
                    'value' => 'Ханты-Мансийск',
                    'start' => 15,
                    'end' => 20,
                ],
            ],
        ];
    }

    private function getResponseObjectByIntentAndEntities(string $intent, array $entities,?string $message = null): array
    {
        $intentModel = ChatIntent::query()
            ->where('code', $intent)
            ->first();

        if (!$intentModel instanceof ChatIntent) {

            Log::channel('chat')->warning('Был определён интент, который еще не был добавлен в базу данных', [
                'vika_type' => $this->chatMessage->vika_type->name,
                'intent' => $intent,
            ]);

            $intentModel = ChatIntent::query()->where('code', 'input.unknown');
        }
        return $intentModel
        ->handler
        ->class::getResponseDataByIntent($intentModel->code, $this->chatMessage->vika_type->name, $entities, $message);
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
}
