<?php

namespace Modules\Chat\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Uri;
use Illuminate\Validation\Rule;
use Modules\Chat\Models\ChatVikaType;
use Modules\Chat\Services\AdminVikaTypeService;
use Modules\Chat\Swagger\Docs\Attributes\AdminVikaTypeController\CreateVikaType;
use Modules\Chat\Swagger\Docs\Attributes\AdminVikaTypeController\DeleteVikaType;
use Modules\Chat\Swagger\Docs\Attributes\AdminVikaTypeController\GetVikaType;
use Modules\Chat\Swagger\Docs\Attributes\AdminVikaTypeController\GetVikaTypes;
use Modules\Chat\Swagger\Docs\Attributes\AdminVikaTypeController\GetVikaTypeWidgetMenu;
use Modules\Chat\Swagger\Docs\Attributes\AdminVikaTypeController\UpdateVikaType;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'AdminWidgetController', description: 'Администрирование типов Вики')]
class AdminVikaTypeController extends Controller
{
    protected AdminVikaTypeService $adminVikaTypeService;

    public function __construct(AdminVikaTypeService $adminVikaTypeService)
    {
        Context::add('module', 'Admin');
        $this->adminVikaTypeService = $adminVikaTypeService;
    }

    #[CreateVikaType]
    public function createVikaType(Request $request)
    {
        $this->transformUrlToHostInRequest($request);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:chat_vika_types,name',
            'description' => 'required|string|max:1000',
            'resources' => 'sometimes|nullable|array',
            'resources.*' => 'nullable|unique:chat_vika_type_resources,resource_host',
        ]);

        return $this->adminVikaTypeService->createVikaType(
            $validated['description'],
            $validated['name'],
            $validated['resources'] ?? [],
        );
    }

    private function transformUrlToHostInRequest(Request $request)
    {
        $resourceUrls = $request->get('resources', []);
        foreach ($resourceUrls as $i => $resourceUrl) {
            if($resourceUrl===null){
                continue;
            }
            if (!preg_match('/^https?:\/\//', $resourceUrl)) {
                $resourceUrl = 'http://' . $resourceUrl;
            }

            $resourceUrls[$i] = Uri::of($resourceUrl)->host();
        }

        $request->merge(['resources' => $resourceUrls]);
    }
    #[UpdateVikaType]
    public function updateVikaType(Request $request, ChatVikaType $vikaType)
    {
        $this->transformUrlToHostInRequest($request);

        $validated = $request->validate([
            'description' => 'required|string|max:1000',
            'resources' => 'sometimes|nullable|array',
            'resources.*' => ['string','nullable', Rule::unique('chat_vika_type_resources', 'resource_host')->ignore($vikaType->id, 'vika_type_id')],
        ]);

        return $this->adminVikaTypeService->updateVikaType(
            $vikaType,
            $validated['description'],
            $validated['resources'] ?? [],
        );
    }
    #[DeleteVikaType]
    public function deleteVikaType(Request $request, ChatVikaType $vikaType)
    {
        return $this->adminVikaTypeService->deleteVikaType($vikaType);
    }
    #[GetVikaTypes]
    public function getVikaTypes(Request $request)
    {
        $validated = $request->validate([
            'query'=>'sometimes|nullable|string',
            'need_pagination' => 'sometimes|nullable|boolean',
            'per_page' => 'sometimes|nullable|integer|min:1',
            'exclude_widgets' => 'sometimes|nullable|array',
            'exclude_widgets.*' => 'integer|exists:chat_widgets,id',
        ]);

        return $this->adminVikaTypeService->getVikaTypes(
            $validated['need_pagination'] ?? false,
            $validated['per_page'] ?? 15,
            $validated['exclude_widgets'] ?? [],
            $validated['query'] ?? null,
        );
    }
    #[GetVikaType]
    public function getVikaType(Request $request, ChatVikaType $vikaType)
    {
        return $this->adminVikaTypeService->getVikaType($vikaType);
    }

    #[GetVikaTypeWidgetMenu]
    public function getVikaTypeWidgetMenu(Request $request, ChatVikaType $vikaType)
    {
        return $this->adminVikaTypeService->getVikaTypeWidgetsMenu($vikaType);
    }

}
