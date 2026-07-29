<?php

namespace Modules\Chat\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Illuminate\Validation\Rule;
use Modules\Chat\Models\ChatAttachedToVikaTypeWidget;
use Modules\Chat\Models\ChatVikaType;
use Modules\Chat\Models\ChatWidget;
use Modules\Chat\Models\ChatWidgetCategory;
use Modules\Chat\Models\ChatWidgetIcon;
use Modules\Chat\Models\ChatWidgetType;
use Modules\Chat\Services\AdminWidgetService;
use Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController\AddWidgetCategoryToVikaType;
use Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController\CreateWidget;
use Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController\CreateWidgetAttachment;
use Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController\DeleteWidget;
use Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController\DeleteWidgetAttachment;
use Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController\DeleteWidgetCategory;
use Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController\GetAllWidgets;
use Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController\GetIcons;
use Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController\GetVikaTypeWidgetCategories;
use Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController\GetWidget;
use Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController\GetWidgetTypes;
use Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController\UpdateWidget;
use Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController\UpdateWidgetAttachment;
use Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController\UpdateWidgetCategory;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'AdminWidgetController', description: 'Администрирование виджетов')]
class AdminWidgetController extends Controller
{
    protected AdminWidgetService $adminWidgetService;

    public function __construct(AdminWidgetService $adminWidgetService)
    {
        $this->adminWidgetService = $adminWidgetService;
        Context::add('module', 'Admin');

    }

    #[AddWidgetCategoryToVikaType]
    public function addWidgetCategoryToVikaType(Request $request, ChatVikaType $vikaType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'sometimes|nullable|string|max:255',
            'icon_id' => 'sometimes|integer|exists:chat_widget_icons,id',
            'order' => 'sometimes|integer',
            'bg_colour' => 'sometimes|string|hex_color|max:9',
            'is_favorite' => 'sometimes|boolean',
        ]);

        return $this->adminWidgetService->addWidgetCategoryToVikaType($vikaType, $validated);
    }

    #[UpdateWidgetCategory]
    public function updateWidgetCategory(Request $request, ChatWidgetCategory $chatWidgetCategory)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|nullable|string|max:255',
            'icon_id' => 'sometimes|nullable|integer|exists:chat_widget_icons,id',
            'order' => 'sometimes|integer',
            'bg_colour' => 'sometimes|string|hex_color|max:9',
            'is_favorite' => 'sometimes|boolean',
        ]);

        return $this->adminWidgetService->updateWidgetCategory($chatWidgetCategory, $validated);
    }

    #[DeleteWidgetCategory]
    public function deleteWidgetCategory(Request $request, ChatWidgetCategory $chatWidgetCategory)
    {
        return $this->adminWidgetService->deleteWidgetCategory($chatWidgetCategory);
    }

    #[GetVikaTypeWidgetCategories]
    public function getVikaTypeWidgetCategories(Request $request, ChatVikaType $vikaType)
    {
        return $this->adminWidgetService->getVikaTypeWidgetCategories($vikaType);
    }

    #[CreateWidget]
    public function createWidget(Request $request)
    {
        $validated = $request->validate([
            'code_name' => 'required|string|max:255|unique:chat_widgets,code_name',
            'name' => 'required|string|max:255',
            'description' => 'sometimes|nullable|string|max:255',
            'icon_id' => 'sometimes|nullable|integer|exists:chat_widget_icons,id',
            'url' => 'required|url|string|max:1000',
            'bg_colour' => 'sometimes|nullable|hex_color|string|max:9',
            'is_active' => 'required|boolean',
        ]);

        $validated['type_id'] = 2;

        return $this->adminWidgetService->createWidget($validated);
    }

    #[UpdateWidget]
    public function updateWidget(Request $request, ChatWidget $chatWidget)
    {
        $validated = $request->validate([
            'code_name' => [
                Rule::excludeIf($chatWidget->type_id == 1),
                Rule::unique('chat_widgets', 'code_name')->ignore($chatWidget->id),
                'sometimes',
                'string',
                'max:255',
            ],
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|nullable|string|max:255',
            'icon_id' => 'sometimes|nullable|integer|exists:chat_widget_icons,id',
            'url' => [Rule::excludeIf($chatWidget->type_id == 1), 'url', 'string', 'max:1000'],
            'bg_colour' => 'sometimes|nullable|hex_color|string|max:9',
            'is_active' => 'required|boolean',
        ]);

        return $this->adminWidgetService->updateWidget($chatWidget, $validated);
    }

    #[DeleteWidget]
    public function deleteWidget(Request $request, ChatWidget $chatWidget)
    {
        return $this->adminWidgetService->deleteWidget($chatWidget);
    }

    #[GetAllWidgets]
    public function getWidgets(Request $request)
    {
        $validated = $request->validate([
            'exclude_vika_types' => 'sometimes|array',
            'exclude_vika_types.*' => 'integer|exists:chat_vika_types,id',
            'include_vika_types' => 'sometimes|array',
            'include_vika_types.*' => 'integer|exists:chat_vika_types,id',
            'is_active' => 'sometimes|boolean',
            'type_id' => 'sometimes|integer|exists:chat_widget_types,id',
            'need_pagination' => 'sometimes|boolean',
            'per_page' => 'sometimes|integer|min:1',
            'query' => 'sometimes|string|nullable',
        ]);

        return $this->adminWidgetService->getWidgets($validated);
    }

    #[GetWidget]
    public function getWidget(Request $request, ChatWidget $chatWidget)
    {
        return $this->adminWidgetService->getWidget($chatWidget);
    }

    #[GetWidgetTypes]
    public function getWidgetTypes()
    {
        return ChatWidgetType::all();
    }

    #[GetIcons]
    public function getIcons()
    {
        return ChatWidgetIcon::all();
    }

    #[CreateWidgetAttachment]
    public function addWidgetToVikaType(Request $request)
    {
        $attributes = $request->validate([
            'chat_widget_id' => 'required|integer|exists:chat_widgets,id',
            'vika_type_id' => 'required|integer|exists:chat_vika_types,id',
            'category_id' => 'sometimes|integer|nullable|exists:chat_widget_categories,id',
            'order' => 'sometimes|integer',
            'is_favorite' => 'sometimes|boolean',
        ]);

        return $this->adminWidgetService->addWidgetToVikaType($attributes);
    }

    #[UpdateWidgetAttachment]
    public function updateAttachedToVikaTypeWidget(Request $request, ChatAttachedToVikaTypeWidget $attachedToVikaTypeWidget)
    {
        $attributes = $request->validate([
            'category_id' => 'sometimes|nullable|integer|exists:chat_widget_categories,id',
            'order' => 'sometimes|integer',
            'is_favorite' => 'sometimes|boolean',
        ]);

        return $this->adminWidgetService->updateAttachedToVikaTypeWidget($attachedToVikaTypeWidget, $attributes);
    }

    #[DeleteWidgetAttachment]
    public function deleteAttachedToVikaTypeWidget(Request $request, ChatAttachedToVikaTypeWidget $attachedToVikaTypeWidget)
    {
        return $this->adminWidgetService->deleteAttachedToVikaTypeWidget($attachedToVikaTypeWidget);
    }
}
