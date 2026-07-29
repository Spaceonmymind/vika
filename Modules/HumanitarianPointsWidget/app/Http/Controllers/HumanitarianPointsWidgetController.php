<?php

namespace Modules\HumanitarianPointsWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\HumanitarianPointsWidget\Models\HumanitarianPointsWidgetMunicipality;
use Modules\HumanitarianPointsWidget\Services\HumanitarianPointsWidgetService;
use Modules\HumanitarianPointsWidget\Swagger\Docs\Attributes\GetHumanitarianPoints;
use Modules\HumanitarianPointsWidget\Swagger\Docs\Attributes\GetMunicipalities;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'HumanitarianPointsWidget', description: 'Виджет "Пункты приёма гуманитарной помощи"')]
class HumanitarianPointsWidgetController extends Controller
{
    private HumanitarianPointsWidgetService $humanitarianPointsWidgetService;

    /**
     * @param HumanitarianPointsWidgetService $humanitarianPointsWidgetService
     */
    public function __construct(HumanitarianPointsWidgetService $humanitarianPointsWidgetService)
    {
        $this->humanitarianPointsWidgetService = $humanitarianPointsWidgetService;
        Context::add('module', 'HumanitarianPointsWidget');

    }

    #[GetMunicipalities]
    public function getMunicipalities(Request $request)
    {
        return HumanitarianPointsWidgetMunicipality::query()
            ->whereHas('humanitarian_points')
            ->get();
    }

    #[GetHumanitarianPoints]
    public function getHumanitarianPoints(Request $request)
    {
        $validated = $request->validate([
            'municipality_id' => 'sometimes|integer|nullable|exists:humanitarian_points_widget_municipalities,id',
        ]);
        return $this->humanitarianPointsWidgetService->getHumanitarianPoints($validated['municipality_id'] ?? null);
    }
}
