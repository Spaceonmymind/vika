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
use Modules\Chat\Events\MadeResponseForMessage;
use Modules\Chat\Helpers\IntentQualifier;
use Modules\Chat\Models\ChatIntent;
use Modules\Chat\Models\ChatMessage;

class SendResponseForMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private ChatMessage $chatMessage;

    /**
     * Create a new job instance.
     */
    public function __construct(ChatMessage $chatMessage)
    {
        $this->chatMessage = $chatMessage;
        Context::add('vika_type_id', $chatMessage->vika_type_id);
        Context::add('message', $chatMessage->message);
        Context::add('chat_id', $chatMessage->chat_id);
        Context::add('from_tg', false);
    }

    /**
     * Execute the job.
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
        if($intentWithEntities['intent']=='welcome'&&$this->chatMessage->vika_type->name=='main'){
            $answer['text'] .= 'Так же меня можно найти в Max : <a href="https://max.ru/ugra_vika_bot">https://max.ru/ugra_vika_bot</a><br>'."<br><br>".'Очень часто у меня спрашивают:'."<br>";
        }
        $this->chatMessage->update([
            'answer' => $answer,
        ]);

        broadcast(new MadeResponseForMessage($this->chatMessage->chat_id, $answer, $this->chatMessage->id));
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

    private function getResponseObjectByIntentAndEntities(string $intent, array $entities, ?string $message = null): array
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
}
