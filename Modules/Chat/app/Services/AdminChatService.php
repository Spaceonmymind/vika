<?php

namespace Modules\Chat\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Modules\Chat\Models\ChatAnswer;
use Modules\Chat\Models\ChatAnswerButton;
use Modules\Chat\Models\ChatIntent;
use Modules\Chat\Models\ChatVikaType;

class AdminChatService
{
    private TolyaClassifierService $tolyaClassifierService;

    public function __construct(TolyaClassifierService $tolyaClassifierService)
    {
        $this->tolyaClassifierService = $tolyaClassifierService;
    }


    /**
     * Возвращает ответы, добавленные в систему
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator|\Modules\Chat\Models\Base\ChatAnswer[]|ChatAnswer[]
     */
    public function getAnswers(array $filters = [])
    {
        return ChatAnswer::query()
            ->select([
                'id',
                'intent_id',
                'name',
                'is_active',
                'created_at',
                'updated_at',
                'vika_type_id',
            ])
            ->with([
                'chat_intent:id,name,code',
                'vika_type:id,name,description',
            ])
            ->when(isset($filters['is_active']), function (Builder $q) use ($filters) {
                $q->where('is_active', $filters['is_active']);
            })
            ->when(isset($filters['intent_id']), function (Builder $q) use ($filters) {
                $q->where('intent_id', $filters['intent_id']);
            })
            ->when(isset($filters['vika_type_id']), function (Builder $q) use ($filters) {
                $q->where('vika_type_id', $filters['vika_type_id']);
            })
            ->when(isset($filters['name']), function (Builder $q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['name'] . '%');
            })
            ->paginate($filters['per_page'] ?? 15);

    }

    /**
     * Возвращает деталку ответа
     * @param ChatAnswer $chatAnswer
     * @return ChatAnswer
     */
    public function getAnswer(ChatAnswer $chatAnswer)
    {
        return $chatAnswer->load([
            'chat_intent:id,name,code',
            'vika_type:id,name,description',
            'chat_answer_texts',
            'chat_answer_buttons',
            'chat_answer_buttons.chat_answer_button_type',
            'chat_answer_buttons.chat_answer_button_entities',
            'chat_answer_buttons.chat_widget:id,name,is_active,description,code_name',
        ]);
    }

    /**
     * Создает ответ
     * @param array $answerAttributes
     * @param array $answerTexts
     * @param array $answerButtons
     * @return array
     */
    public function createAnswer(array $answerAttributes, array $answerTexts, array $answerButtons)
    {
        $intent = ChatIntent::query()->find($answerAttributes['intent_id']);
        $vikaType = ChatVikaType::query()->find($answerAttributes['vika_type_id']);
        $successSendInformationToAI = true;
        if ($answerAttributes['is_active']) {

            if (!$successSendInformationToAI = $this->tolyaClassifierService->addVikaTypeToIntent($intent->external_id, $vikaType->name)) {

                $answerAttributes['is_active'] = false;

            }

        }

        $answer = ChatAnswer::create($answerAttributes);

        $this->saveAnswerTexts($answer, $answerTexts);
        $this->saveAnswerButtons($answer, $answerButtons);


        if (!$successSendInformationToAI) {
            return [
                'success' => false,
                'error' => 'Не удалось отправить информацию в ИИ. Ответ создан неактивным',
            ];

        }

        return [
            'success' => true,
        ];

    }

    /**
     * Сохраняет текстовки(html) ответа
     * @param ChatAnswer $chatAnswer
     * @param array $answerTexts
     * @return void
     */
    private function saveAnswerTexts(ChatAnswer $chatAnswer, array $answerTexts)
    {
        $chatAnswer->chat_answer_texts()->delete();

        foreach ($answerTexts as $answerText) {
            $chatAnswer->chat_answer_texts()->create(['text' => $answerText]);
        }

    }

    /**
     * Сохраняет кнопки ответа
     * @param ChatAnswer $chatAnswer
     * @param array $answerButtons
     * @return void
     */
    private function saveAnswerButtons(ChatAnswer $chatAnswer, array $answerButtons)
    {
        $chatAnswer->chat_answer_buttons()->delete();

        foreach ($answerButtons as $answerButton) {
            /**
             * @var ChatAnswerButton $button
             */
            $button = $chatAnswer->chat_answer_buttons()->create($answerButton);

            foreach ($answerButton['chat_answer_button_entities'] as $entity) {
                $button->chat_answer_button_entities()->create($entity);
            }
        }
    }

    /**
     * Апдейт ответа
     * @param ChatAnswer $chatAnswer
     * @param array $answerAttributes
     * @param array|null $answerTexts
     * @param array|null $answerButtons
     * @return array
     */
    public function updateAnswer(ChatAnswer $chatAnswer, array $answerAttributes, ?array $answerTexts, ?array $answerButtons)
    {
        if (in_array($chatAnswer->chat_intent->code, ['input.unknown', 'welcome'])) {
            $answerAttributes['is_active'] = true;
        }

        $successSendInformationToAI = true;

        if ($chatAnswer->is_active != $answerAttributes['is_active']) {

            if ($answerAttributes['is_active']) {
                $successSendInformationToAI = $this->tolyaClassifierService->addVikaTypeToIntent($chatAnswer->chat_intent->external_id, $chatAnswer->vika_type->name);
            } else {
                $successSendInformationToAI = $this->tolyaClassifierService->removeVikaTypeFromIntent($chatAnswer->chat_intent->external_id, $chatAnswer->vika_type->name);
            }

            if (!$successSendInformationToAI) {

                unset($answerAttributes['is_active']);
            }
        }

        $chatAnswer->update($answerAttributes);

        if (isset($answerTexts)) {
            $this->saveAnswerTexts($chatAnswer, $answerTexts);
        }

        if (isset($answerButtons)) {
            $this->saveAnswerButtons($chatAnswer, $answerButtons);

        }

        if (!$successSendInformationToAI) {
            return [
                'success' => false,
                'error' => 'Не удалось отправить информацию в ИИ. Активность ответа осталась неизменной',
            ];
        }

        return ['success' => true];
    }

    /**
     * Удаление ответа
     * @param ChatAnswer $chatAnswer
     * @return array
     */
    public function deleteAnswer(ChatAnswer $chatAnswer)
    {
        if (in_array($chatAnswer->chat_intent->code, ['input.unknown', 'welcome'])) {
            return [
                'success' => false,
                'error' => 'Нельзя удалять ответы для Default Fallback Intent и Default Welcome Intent',
            ];
        }

        if ($chatAnswer->is_active) {

            if (!$this->tolyaClassifierService->removeVikaTypeFromIntent($chatAnswer->chat_intent->external_id, $chatAnswer->vika_type->name)) {
                return [
                    'success' => false,
                    'error' => 'Не удалось отправить информацию в ИИ. Попробуйте позже',
                ];
            }

        }

        $chatAnswer->delete();

        return ['success' => true];
    }
}
