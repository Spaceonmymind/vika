<?php

namespace Modules\Chat\IntentHandlers;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Log;
use Modules\Chat\Helpers\IntentQualifier;
use Modules\Chat\Models\ChatIntent;

class AnswerFromLLMWithPromptChatHandler extends AnswerFromLLMChatHandler
{
    /**
     * Возвращает объект ответа с сообщением и кнопочками по определенному интенту и сущностям
     *
     * @param string $intent - Определенный интент
     * @param string $vikaType - Тип Вики
     * @param array $entities - Массив определенных сущностей
     * @param string|null $message - Сообщение, которое было отправлено в чат
     * @return array
     */
    public static function getResponseDataByIntent(string $intent, string $vikaType, array $entities, ?string $message): array
    {
        $intentModel = ChatIntent::query()
            ->with([
                'chat_answers' => function (Builder $q) use ($vikaType) {
                    $q
                        ->whereHas('vika_type', function (Builder $q) use ($vikaType) {
                            $q->where('name', $vikaType);
                        })
                        ->where('is_active', true)
                        ->limit(1);
                },
                'chat_answers.chat_answer_buttons',
                'chat_answers.chat_answer_buttons.chat_widget.type',
                'chat_answers.chat_answer_buttons.chat_answer_button_entities',
                'chat_answers.chat_answer_texts' => function (Builder $q) {
                    $q
                        ->inRandomOrder()
                        ->limit(1);
                },
            ])
            ->where('code', $intent)
            ->where('active', true)
            ->first();


        if (!$intentModel instanceof ChatIntent) {

            Log::channel('chat')->warning('Определитель интентов нашел интент, который не активен', [
                'intent' => $intent,
                'vikaType' => $vikaType,
                'entities' => json_encode($entities, JSON_UNESCAPED_UNICODE),
            ]);

            return [
                'text' => 'Извините, кажется, я вас не поняла...',
                'buttons' => [],
            ];
        }

        if ($intentModel->chat_answers->isEmpty() || $intentModel->system_prompt === null || $intentModel->document === null) {

            Log::channel('chat')->warning('Был обнаружен интент, для которого нет ответа для заданного типа вики', [
                'intent' => $intent,
                'vikaType' => $vikaType,
                'entities' => json_encode($entities, JSON_UNESCAPED_UNICODE),
            ]);

            return [
                'text' => 'Извините, кажется, я вас не поняла...',
                'buttons' => [],
            ];
        }
        $responseFromLLM = IntentQualifier::getResponseMessageFromLLMByDocumentAndPrompt($intentModel->document, $intentModel->system_prompt, $message);

        //$entities=$responseFromLLM['filters'];
        $responseFromLLM['answer']=mb_ereg_replace('\n','<br>',$responseFromLLM['answer']);

        if (Context::get('message', false) !== false) {
            static::saveHistoryRecord(
                $intentModel->id ?? 9,
                Context::get('message'),
                Context::get('vika_type_id', 1),
                Context::get('chat_id'),
                $entities,
                Context::get('from_tg', false),
                    Context::get('from_max', false),
            );
        }
        //$entities = static::getAssocEntities($entities);

        return [
            'text' => $responseFromLLM['answer'],
            'buttons' => static::getAnswerButtons($intentModel->chat_answers[0]->chat_answer_buttons, $entities),
        ];
    }

}
