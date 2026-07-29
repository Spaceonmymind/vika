<?php

namespace Modules\InformationSystemsWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\InformationSystemsWidget\Models\Operator;
use Modules\InformationSystemsWidget\Models\Owner;
use Modules\InformationSystemsWidget\Models\Purpose;
use Modules\InformationSystemsWidget\Services\InformationSystemsWidgetService;
use Modules\InformationSystemsWidget\Swagger\Docs\Attributes\GetInformationSystems;
use Modules\InformationSystemsWidget\Swagger\Docs\Attributes\GetOperators;
use Modules\InformationSystemsWidget\Swagger\Docs\Attributes\GetOwners;
use Modules\InformationSystemsWidget\Swagger\Docs\Attributes\GetPurposes;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'InformationSystemsWidget', description: 'Виджет "Информационные системы"')]
class InformationSystemsWidgetController extends Controller
{
    private InformationSystemsWidgetService $informationSystemsWidgetService;

    public function __construct(InformationSystemsWidgetService $informationSystemsWidgetService)
    {
        $this->informationSystemsWidgetService = $informationSystemsWidgetService;
        Context::add('module', 'InformationSystemsWidget');

    }

    #[GetInformationSystems]
    public function getListOfInformationSystems(Request $request)
    {
        $validated = $request->validate([
            'owner_id' => 'sometimes|exists:information_systems_widget_owners,id|nullable',
            'operator_id' => 'sometimes|exists:information_systems_widget_operators,id|nullable',
            'purpose_id' => 'sometimes|exists:information_systems_widget_purposes,id|nullable',
            'name' => 'sometimes|nullable|string',
        ]);

        return $this->informationSystemsWidgetService->getListOfInformationSystems(
            $validated['owner_id'] ?? null,
            $validated['operator_id'] ?? null,
            $validated['purpose_id'] ?? null,
            $validated['name'] ?? null
        );
    }

    #[GetOwners]
    public function getListOfOwners(Request $request)
    {
        return Owner::all();
    }

    #[GetPurposes]
    public function getListOfPurposes(Request $request)
    {
        return Purpose::all();
    }

    #[GetOperators]
    public function getListOfOperators(Request $request)
    {
        return Operator::all();
    }
}
