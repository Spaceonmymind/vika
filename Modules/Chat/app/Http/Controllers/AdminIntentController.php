<?php

namespace Modules\Chat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\Chat\Models\ChatIntent;
use Modules\Chat\Models\ChatIntentHandler;
use Modules\Chat\Models\ChatIntentTestRequest;
use Modules\Chat\Services\AdminIntentService;
use Modules\Chat\Swagger\Docs\Attributes\AdminIntentController\AddTestRequestTotIntent;
use Modules\Chat\Swagger\Docs\Attributes\AdminIntentController\CanAddTestRequestTotIntent;
use Modules\Chat\Swagger\Docs\Attributes\AdminIntentController\CreateIntent;
use Modules\Chat\Swagger\Docs\Attributes\AdminIntentController\DeleteIntent;
use Modules\Chat\Swagger\Docs\Attributes\AdminIntentController\DeleteTestRequestFromIntent;
use Modules\Chat\Swagger\Docs\Attributes\AdminIntentController\GetHandlers;
use Modules\Chat\Swagger\Docs\Attributes\AdminIntentController\GetIntent;
use Modules\Chat\Swagger\Docs\Attributes\AdminIntentController\GetIntents;
use Modules\Chat\Swagger\Docs\Attributes\AdminIntentController\GetPlot;
use Modules\Chat\Swagger\Docs\Attributes\AdminIntentController\GetRecommendedTestRequests;
use Modules\Chat\Swagger\Docs\Attributes\AdminIntentController\TestLLMPrompt;
use Modules\Chat\Swagger\Docs\Attributes\AdminIntentController\TestMessage;
use Modules\Chat\Swagger\Docs\Attributes\AdminIntentController\UpdateIntent;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'AdminIntentController', description: 'Администрирование нейросети')]
class AdminIntentController
{
    private AdminIntentService $adminIntentService;

    /**
     * @param AdminIntentService $adminIntentService
     */
    public function __construct(AdminIntentService $adminIntentService)
    {
        $this->adminIntentService = $adminIntentService;
        Context::add('module', 'Admin');

    }

    #[GetIntents]
    public function getIntents(Request $request)
    {
        $validated = $request->validate([
            'need_pagination' => 'sometimes|boolean|nullable',
            'per_page' => 'sometimes|integer|nullable',
            'name' => 'sometimes|string|nullable',
            'active' => 'sometimes|boolean|nullable',
            'exclude_vika_type_id' => 'sometimes|integer|nullable|exists:chat_vika_types,id',
        ]);

        return $this->adminIntentService->getIntents($validated);
    }

    #[CreateIntent]
    public function createIntent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:chat_intents,code',
            'handler_id'=>'required|integer|exists:chat_intent_handlers,id',
            'active' => 'required|boolean',
            'document'=>'required_if:handler_id,4|string|nullable',
            'system_prompt'=>'required_if:handler_id,4|string|nullable',
        ]);
        return $this->adminIntentService->createIntent($validated);
    }

    #[GetIntent]
    public function getIntent(ChatIntent $chatIntent, Request $request)
    {
        return $this->adminIntentService->getIntent($chatIntent);
    }

    #[UpdateIntent]
    public function updateIntent(Request $request, ChatIntent $chatIntent)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'active' => 'required|boolean',
            'handler_id'=>'sometimes|integer|exists:chat_intent_handlers,id',
            'document'=>'required_if:handler_id,4|string|nullable',
            'system_prompt'=>'required_if:handler_id,4|string|nullable',
        ]);
        return $this->adminIntentService->updateIntent($chatIntent, $validated);
    }

    #[DeleteIntent]
    public function deleteIntent(ChatIntent $chatIntent, Request $request)
    {
        return $this->adminIntentService->deleteIntent($chatIntent);
    }

    #[CanAddTestRequestTotIntent]
    public function canAddTestRequest(Request $request, ChatIntent $chatIntent)
    {
        $validated = $request->validate([
            'text' => 'required|string',
        ]);
        return $this->adminIntentService->canAddTestRequest($chatIntent, $validated['text']);
    }

    #[AddTestRequestTotIntent]
    public function addTestRequest(Request $request, ChatIntent $chatIntent)
    {
        $validated = $request->validate([
            'text' => 'required|string',
        ]);
        return $this->adminIntentService->addTestRequest($chatIntent, $validated['text']);
    }


    #[DeleteTestRequestFromIntent]
    public function deleteTestRequest(ChatIntentTestRequest $testRequest, Request $request)
    {
        return $this->adminIntentService->deleteTestRequest($testRequest);
    }

    #[GetRecommendedTestRequests]
    public function getRecommendedTestRequests(ChatIntent $chatIntent, Request $request)
    {
        return $this->adminIntentService->getRecommendedTestRequests($chatIntent);
    }

    #[GetPlot]
    public function getPlot(Request $request)
    {
        $validated = $request->validate([
            'force_update' => 'sometimes|boolean|nullable',
        ]);
        return $this->adminIntentService->getPlot($validated['force_update'] ?? false);
    }

    #[TestMessage]
    public function testMessage(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string',
            'vika_type' => 'sometimes|string|nullable|exists:chat_vika_types,name',
        ]);

        return $this->adminIntentService->testMessage(
            $validated['text'],
            $validated['vika_type'] ?? null,
        );
    }

    #[GetHandlers]
    public function getIntentHandlers()
    {
        return ChatIntentHandler::query()->get();
    }

    #[TestLLMPrompt]
    public function testLLMPrompt(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
            'document' => 'required|string',
            'system_prompt' => 'required|string',
        ]);
        return $this->adminIntentService->testLLMPrompt(
            $validated['message'],
            $validated['system_prompt'],
            $validated['document'],
        );
    }
}
