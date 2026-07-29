<?php

namespace Modules\Chat\IntentHandlers;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Database\Query\Builder as DBBuilder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Chat\Models\ChatAnswerButton;
use Modules\Chat\Models\ChatAnswerButtonEntity;
use Modules\Chat\Models\ChatIntent;
use Modules\Chat\Models\ChatIntentHistoryRecord;

class DefaultChatHandler implements ChatIntentHandlerInterface
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

        if ($intentModel->chat_answers->isEmpty()) {

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

        if ($intentModel->chat_answers[0]->chat_answer_texts->isEmpty()) {

            Log::channel('chat')->warning('Был обнаружен интент, для которого нет текста ответа для заданного типа вики', [
                'intent' => $intent,
                'vikaType' => $vikaType,
                'entities' => json_encode($entities, JSON_UNESCAPED_UNICODE),
            ]);

            return [
                'text' => 'Извините, кажется, я вас не поняла...',
                'buttons' => [],
            ];
        }

        $entities = static::getAssocEntities($entities);

        return [
            'text' => static::getAnswerText($intentModel),
            'buttons' => static::getAnswerButtons($intentModel->chat_answers[0]->chat_answer_buttons, $entities),
        ];
    }

    protected static function saveHistoryRecord(
        int $intentId,
        string $message,
        int $vikaTypeId,
        int|string $chatId,
        array $entities,
        bool $fromTg = false,
        bool $fromMax = false,
    ): void {
        ChatIntentHistoryRecord::query()->create([
            'intent_id' => $intentId,
            'message' => $message,
            'vika_type_id' => $vikaTypeId,
            'chat_id' => $chatId,
            'entities' => $entities,
            'from_tg' => $fromTg,
            'from_max' => $fromMax,
        ]);
    }

    /**
     * Возвращает найденные сущности сгруппированные по типу
     * @param array $entities
     * @return array
     */
    protected static function getAssocEntities(array $entities): array
    {
        $assocEntities = [];

        foreach ($entities as $entity) {
            $assocEntities[$entity['type']][] = $entity['value'];
        }

        return $assocEntities;
    }

    protected static function getAnswerText(ChatIntent $intentModel): string
    {
        return $intentModel->chat_answers[0]->chat_answer_texts[0]->text;
    }

    /**
     * Возвращает кнопки, с подставленными параметрами из сущностей для отправки в чат
     *
     * @param Collection $answerButtons - Кнопки, которые должны быть у найденного ответа
     * @param array $entities - Массив сущностей сгруппированных по типу
     * @return array
     */
    protected static function getAnswerButtons(Collection $answerButtons, array $entities): array
    {
        $buttons = [];
        /**
         * @var ChatAnswerButton $answerButton
         */
        foreach ($answerButtons as $answerButton) {

            $buttonParams = static::getEntityParamsForButton($entities, $answerButton->chat_answer_button_entities);

            if ($answerButton->button_type_id == 1) {
                $buttons[] = [
                    'type' => $answerButton->chat_answer_button_type->code,
                    'text' => $answerButton->button_message_text,
                    'widget' => $answerButton->chat_widget->code_name,
                    'widget_id' => $answerButton->chat_widget->id,
                    'params' => $buttonParams,
                    'widget_url' => $answerButton->chat_widget->widget_public_url,
                    'widget_type' => $answerButton->chat_widget->type->code,
                ];
            }

            if ($answerButton->button_type_id == 2) {

                $buttonUrlParams = '';

                if (!empty($buttonParams)) {
                    $buttonUrlParams = '?' . http_build_query($buttonParams);
                }

                $buttons[] = [
                    'type' => $answerButton->chat_answer_button_type->code,
                    'text' => $answerButton->button_message_text,
                    'url' => $answerButton->url . $buttonUrlParams,
                ];
            }

        }
        return $buttons;
    }

    /**
     * Возвращает массив обработанных сущностей для конкретной кнопки(может быть такое, что одна сущность(фильтр) используется в одной кнопке, а вторая в другой)
     *
     * @param array $entities
     * @param Collection $buttonEntities - Сущности, которые принимает кнопка
     * @return array
     */
    protected static function getEntityParamsForButton(array $entities, Collection $buttonEntities): array
    {
        $foundButtonParams = [];
        /**
         * @var ChatAnswerButtonEntity $buttonEntity
         */
        foreach ($buttonEntities as $buttonEntity) {

            if (!isset($entities[$buttonEntity->code])) {
                continue;
            }

            if (!isset($buttonEntity->table)) {
                if (isset($entities[$buttonEntity->code][0])) {
                    $foundButtonParams[$buttonEntity->param_name] = $buttonEntity->multiple ? $entities[$buttonEntity->code] : $entities[$buttonEntity->code][0];
                }
                continue;
            }

            $entityValue = static::getEntityValueFromDB($buttonEntity, $entities[$buttonEntity->code]);

            if ($entityValue !== null) {
                $foundButtonParams[$buttonEntity->param_name] = $entityValue;
            }

        }
        return $foundButtonParams;
    }

    /**
     * Ищет значения для сущностей в базе данных
     *
     * @param ChatAnswerButtonEntity $buttonEntity - Сущность, которая обрабатывается для кнопки
     * @param array $entityValues - Значения определенной найденной сущности
     * @return array|null
     */
    protected static function getEntityValueFromDB(ChatAnswerButtonEntity $buttonEntity, array $entityValues): array|int|string|null
    {
        try {

            $foundEntitiesInDB =
                DB::table($buttonEntity->table)
                    ->when($buttonEntity->multiple,
                        function (DBBuilder $q) use ($buttonEntity, $entityValues) {
                            $q->whereIn($buttonEntity->search_column, $entityValues);
                        },
                        function (DBBuilder $q) use ($buttonEntity, $entityValues) {
                            $q->where($buttonEntity->search_column, $entityValues[0]);
                        })
                    ->pluck($buttonEntity->value_column);

            if ($foundEntitiesInDB->isNotEmpty()) {

                if ($buttonEntity->multiple) {

                    return $foundEntitiesInDB->toArray();

                }

                return $foundEntitiesInDB[0];

            }
        } catch (\Throwable $e) {
            Log::channel('chat')->error('Ошибка при поиске сущностей в БД', [
                'entity' => $buttonEntity->toArray(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);
        }
        return null;
    }
}
