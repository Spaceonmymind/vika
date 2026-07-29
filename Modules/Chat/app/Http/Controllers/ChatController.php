<?php

namespace Modules\Chat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Context;
use Modules\Chat\Models\ChatWidget;
use Modules\Chat\Services\ChatService;
use Modules\Chat\Swagger\Docs\Attributes\CreateWidgetUsageRecord;
use Modules\Chat\Swagger\Docs\Attributes\GetChatHints;
use Modules\Chat\Swagger\Docs\Attributes\GetChatMessages;
use Modules\Chat\Swagger\Docs\Attributes\GetVikaTypeByResourceUrl;
use Modules\Chat\Swagger\Docs\Attributes\GetWidgetInfoByCode;
use Modules\Chat\Swagger\Docs\Attributes\GetWidgetsList;
use Modules\Chat\Swagger\Docs\Attributes\HandleIncomingMessage;
use Modules\Chat\Swagger\Docs\Attributes\UpdateAndGetWidgetsList;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Chat', description: 'Управление чатом')]
class ChatController extends Controller
{
    private ChatService $chatService;

    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
        Context::add('module', 'Chat');

    }

    #[GetChatMessages]
    public function getChatMessages(Request $request): Paginator
    {
        $validated = $request->validate([
            'chat_id' => 'required|uuid',
            'vika_type' => 'sometimes|nullable|exists:chat_vika_types,name',
        ]);
        return $this->chatService->getChatMessages($validated['chat_id'], $validated['vika_type'] ?? 'main');
    }

    #[GetWidgetsList]
    public function getWidgetsList(Request $request): array
    {
        $validated = $request->validate([
            'vika_type' => 'sometimes|exists:chat_vika_types,name',
        ]);

        return $this->chatService->getWidgetsList($validated['vika_type'] ?? 'main');
    }

    #[HandleIncomingMessage]
    public function handleIncomingMessage(Request $request): array
    {

        $validated = $request->validate([
            'chat_id' => 'required|uuid',
            'message' => 'required|string',
            'vika_type' => 'sometimes|nullable|exists:chat_vika_types,name',
        ]);

        return $this->chatService->handleIncomingMessage(
            $validated['chat_id'],
            $validated['message'],
            $validated['vika_type'] ?? 'main',
        );
    }

    #[UpdateAndGetWidgetsList]
    public function updateAndGetWidgetsList(Request $request)
    {

        return $this->chatService->updateAndGetWidgetsList();
    }

    #[GetChatHints]
    public function getChatHints(Request $request)
    {
        $validated = $request->validate([
            'vika_type' => 'sometimes|exists:chat_vika_types,name',
            'query' => 'sometimes|nullable|string',
        ]);
        return $this->chatService->getChatHints($validated['vika_type'] ?? 'main', $validated['query'] ?? '');
    }

    #[CreateWidgetUsageRecord]
    public function createWidgetUsageRecord(Request $request)
    {
        $validated = $request->validate([
            'chat_id' => 'sometimes',
            'widget_code_name' => 'required|exists:chat_widgets,code_name',
            'from_tg' => 'sometimes|nullable|boolean',
            'from_max' => 'sometimes|nullable|boolean',
        ]);

        return $this->chatService->createWidgetUsageRecord(
            $validated['widget_code_name'],
            $validated['chat_id'] ?? null,
            $validated['from_tg'] ?? false,
            $validated['from_max'] ?? false,
        );
    }

    #[GetWidgetInfoByCode]
    public function getWidgetInfoByCode(ChatWidget $widget)
    {
        return $this->chatService->getWidgetInfoByCode($widget);
    }

    #[GetVikaTypeByResourceUrl]
    public function getVikaTypeByResourceUrl(Request $request)
    {
        $validated = $request->validate([
            'resource_url' => 'required|url',
        ]);

        return $this->chatService->getVikaTypeByResourceUrl($validated['resource_url']);
    }
}
