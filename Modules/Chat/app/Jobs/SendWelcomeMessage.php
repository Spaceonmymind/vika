<?php

namespace Modules\Chat\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Log;
use Modules\Chat\Events\MadeResponseForMessage;
use Modules\Chat\Models\ChatIntent;
use Modules\Chat\Models\ChatMessage;
use Modules\Chat\Models\ChatVikaType;

class SendWelcomeMessage implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Get the unique ID for the job.
     */
    public function uniqueId(): string
    {

        return $this->chatUid;

    }

    private string $chatUid;
    private string $vikaType;

    /**
     * Create a new job instance.
     */
    public function __construct(string $chatUid, string $vikaType)
    {
        $this->chatUid = $chatUid;
        $this->vikaType = $vikaType;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $answer = $this->getWelcomeMessage('welcome');

        ChatMessage::create([
            'chat_id' => $this->chatUid,
            'answer' => $answer,
            'vika_type_id' => ChatVikaType::query()->where('name', $this->vikaType)->first()->id,
        ]);
        $answer['text'] .= 'Так же меня можно найти в Max : <a href="https://max.ru/ugra_vika_bot">https://max.ru/ugra_vika_bot</a><br>'."<br><br>".'Очень часто у меня спрашивают:'."<br>";
        broadcast(new MadeResponseForMessage($this->chatUid, $answer, null));
    }


    private function getWelcomeMessage(string $intent)
    {
        $intentModel = ChatIntent::query()
            ->where('code', 'welcome')
            ->first();

        if (!$intentModel instanceof ChatIntent) {

            Log::channel('chat')->warning('Был определён интент, который еще не был добавлен в базу данных', [
                'vika_type' => $this->vikaType,
                'intent' => $intent,
            ]);

            $intentModel = ChatIntent::query()->where('code', 'input.unknown');

        }
        return $intentModel
            ->handler
            ->class::getResponseDataByIntent($intentModel->code, $this->vikaType, [],null);

    }
}
