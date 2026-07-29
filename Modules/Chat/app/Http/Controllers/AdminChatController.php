<?php

namespace Modules\Chat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Illuminate\Validation\Rule;
use Modules\Chat\Models\ChatAnswer;
use Modules\Chat\Models\ChatAnswerButtonType;
use Modules\Chat\Models\ChatVikaType;
use Modules\Chat\Models\ChatWidget;
use Modules\Chat\Services\AdminChatService;
use Modules\Chat\Swagger\Docs\Attributes\AdminChatController\CreateChatAnswer;
use Modules\Chat\Swagger\Docs\Attributes\AdminChatController\DeleteAnswer;
use Modules\Chat\Swagger\Docs\Attributes\AdminChatController\GetAnswer;
use Modules\Chat\Swagger\Docs\Attributes\AdminChatController\GetAnswers;
use Modules\Chat\Swagger\Docs\Attributes\AdminChatController\GetButtonTypes;
use Modules\Chat\Swagger\Docs\Attributes\AdminChatController\UpdateAnswer;
use Modules\Chat\Swagger\Docs\Attributes\AdminIntentController\GetIntents;
use Modules\Chat\Swagger\Docs\Attributes\AdminVikaTypeController\GetVikaTypes;
use Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController\GetAllWidgets;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'AdminChatController', description: 'Администрирование чата')]
#[OA\Tag(name: 'AdminVikaTypeController', description: 'Администрирование типов вики')]
#[OA\Tag(name: 'AdminWidgetController', description: 'Администрирование виджетов')]
class AdminChatController extends Controller
{

    private AdminChatService $adminChatService;

    public function __construct(AdminChatService $adminChatService)
    {
        $this->adminChatService = $adminChatService;
        Context::add('module', 'Admin');
    }




/*    #[GetAllWidgets]
    public function getAllWidgets(Request $request)
    {
        $validated = $request->validate([
            'vika_type_id' => 'sometimes|integer|nullable|exists:chat_vika_types,id',
        ]);

        return ChatWidget::query()
            ->when(isset($validated['vika_type_id']), function ($q) use ($validated) {
                $q->whereHas('attached_to_vika_type_widgets', function ($q) use ($validated) {
                    $q->where('vika_type_id', '=', $validated['vika_type_id']);
                });
            })
            ->get();
    }*/

    #[GetButtonTypes]
    public function getAnswerButtonTypes(Request $request)
    {
        return ChatAnswerButtonType::all();
    }

    #[GetAnswers]
    public function getAnswers(Request $request)
    {
        $validated = $request->validate([
            'intent_id' => 'sometimes|integer|nullable|exists:chat_intents,id',
            'need_pagination' => 'sometimes|boolean|nullable',
            'per_page' => 'sometimes|integer|nullable',
            'vika_type_id' => 'sometimes|integer|nullable|exists:chat_vika_types,id',
            'is_active' => 'sometimes|boolean|nullable',
            'name' => 'sometimes|string|nullable',
        ]);

        return $this->adminChatService->getAnswers($validated);
    }

    #[GetAnswer]
    public function getAnswer(Request $request, ChatAnswer $answer)
    {
        return $this->adminChatService->getAnswer($answer);
    }

    #[CreateChatAnswer]
    public function createAnswer(Request $request)
    {

        $validated = $request->validate([
            'intent_id' => [
                'required',
                'integer',
                'exists:chat_intents,id',
                Rule::unique('chat_answers', 'intent_id')->where('vika_type_id', $request->get('vika_type_id')),
            ],
            'vika_type_id' => [
                'required',
                'integer',
                'exists:chat_vika_types,id',
                Rule::unique('chat_answers', 'vika_type_id')->where('intent_id', $request->get('intent_id')),
            ],
            'name' => 'required',
            'is_active'=>'required|boolean',

            'chat_answer_texts' => 'required|array',
            'chat_answer_texts.*' => 'required|string',

            'chat_answer_buttons' => 'sometimes|array',
            'chat_answer_buttons.*.button_type_id' => 'required|integer|exists:chat_answer_button_types,id',
            'chat_answer_buttons.*.name' => 'required|string',
            'chat_answer_buttons.*.button_message_text' => 'required|string',
            'chat_answer_buttons.*.url' => 'required_if:chat_answer_buttons.*.button_type_id,2|nullable|string',
            'chat_answer_buttons.*.chat_widget_id' => 'required_if:chat_answer_buttons.*.button_type_id,1|nullable|integer',

            'chat_answer_buttons.*.chat_answer_button_entities' => 'sometimes|array',
            'chat_answer_buttons.*.chat_answer_button_entities.*.name' => 'required|string',
            'chat_answer_buttons.*.chat_answer_button_entities.*.code' => 'required|string',
            'chat_answer_buttons.*.chat_answer_button_entities.*.param_name' => 'required|string',
            'chat_answer_buttons.*.chat_answer_button_entities.*.multiple' => 'required|boolean',
            'chat_answer_buttons.*.chat_answer_button_entities.*.table' => 'required_with:chat_answer_buttons.*.chat_answer_button_entities.*.table,chat_answer_buttons.*.chat_answer_button_entities.*.value_column|string|nullable',
            'chat_answer_buttons.*.chat_answer_button_entities.*.search_column' => 'required_with:chat_answer_buttons.*.chat_answer_button_entities.*.table,chat_answer_buttons.*.chat_answer_button_entities.*.value_column|string|nullable',
            'chat_answer_buttons.*.chat_answer_button_entities.*.value_column' => 'required_with:chat_answer_buttons.*.chat_answer_button_entities.*.table,chat_answer_buttons.*.chat_answer_button_entities.*.search_column|string|nullable',

        ]);
        return $this->adminChatService->createAnswer($validated, $validated['chat_answer_texts'], $validated['chat_answer_buttons'] ?? []);
    }

    #[UpdateAnswer]
    public function updateAnswer(Request $request, ChatAnswer $answer)
    {

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'is_active' => 'sometimes|boolean',

            'chat_answer_texts' => 'required|array',
            'chat_answer_texts.*' => 'required|string',

            'chat_answer_buttons' => 'sometimes|array',
            'chat_answer_buttons.*.button_type_id' => 'required|integer|exists:chat_answer_button_types,id',
            'chat_answer_buttons.*.name' => 'required|string',
            'chat_answer_buttons.*.button_message_text' => 'required|string',
            'chat_answer_buttons.*.url' => 'required_if:chat_answer_buttons.*.button_type_id,2|nullable|string',
            'chat_answer_buttons.*.chat_widget_id' => 'required_if:chat_answer_buttons.*.button_type_id,1|nullable|integer',

            'chat_answer_buttons.*.chat_answer_button_entities' => 'sometimes|array',
            'chat_answer_buttons.*.chat_answer_button_entities.*.name' => 'required|string',
            'chat_answer_buttons.*.chat_answer_button_entities.*.code' => 'required|string',
            'chat_answer_buttons.*.chat_answer_button_entities.*.param_name' => 'required|string',
            'chat_answer_buttons.*.chat_answer_button_entities.*.multiple' => 'required|boolean',
            'chat_answer_buttons.*.chat_answer_button_entities.*.table' => 'required_with:chat_answer_buttons.*.chat_answer_button_entities.*.table,chat_answer_buttons.*.chat_answer_button_entities.*.value_column|nullable|string',
            'chat_answer_buttons.*.chat_answer_button_entities.*.search_column' => 'required_with:chat_answer_buttons.*.chat_answer_button_entities.*.table,chat_answer_buttons.*.chat_answer_button_entities.*.value_column|nullable|string',
            'chat_answer_buttons.*.chat_answer_button_entities.*.value_column' => 'required_with:chat_answer_buttons.*.chat_answer_button_entities.*.table,chat_answer_buttons.*.chat_answer_button_entities.*.search_column|nullable|string',

        ]);
        return $this->adminChatService->updateAnswer($answer, $validated, $validated['chat_answer_texts'], $validated['chat_answer_buttons'] ?? []);
    }

    #[DeleteAnswer]
    public function deleteAnswer(Request $request, ChatAnswer $answer)
    {
        return $this->adminChatService->deleteAnswer($answer);
    }
}
