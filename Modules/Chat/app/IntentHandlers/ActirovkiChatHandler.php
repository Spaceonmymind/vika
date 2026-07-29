<?php

namespace Modules\Chat\IntentHandlers;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Log;
use Modules\ActirovkiWidget\Models\City;
use Modules\ActirovkiWidget\Services\ActirovkiService;
use Modules\Chat\Models\ChatIntent;

class ActirovkiChatHandler extends DefaultChatHandler
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
        if (isset($entities['locality']) || isset($entities['city'])) {

            $entities['locality'] = $entities['locality'] ?? $entities['city'];

            $actirovkiCity = City::query()->where('name', 'like', '%' . $entities['locality'][0] . '%')->first();

            if ($actirovkiCity instanceof City) {

                $entities['city_id'] = [$actirovkiCity->id];
                return [
                    'text' => self::getResponseMessageForLocality($actirovkiCity),
                    'buttons' => static::getAnswerButtons($intentModel->chat_answers[0]->chat_answer_buttons, $entities),
                ];

            }
        }

        return [
            'text' => static::getAnswerText($intentModel),
            'buttons' => static::getAnswerButtons($intentModel->chat_answers[0]->chat_answer_buttons, $entities),
        ];
    }

    private static function getResponseMessageForLocality(City $actirovkiCity): string
    {

        $actirovkiService = new ActirovkiService();
        $actirovkiInCity = $actirovkiService->fetchActirovkiToday($actirovkiCity->id);
        $firstRow = true;
        $message = 'В <b>' . $actirovkiCity->name . '</b><br>';
        foreach ($actirovkiInCity as $actirovka) {

            if (!$firstRow) {
                $message .= '<br><br>';
            }

            $message .= $actirovka->message;

            $firstRow = false;
        }
        return $message;
    }
}
