<?php

namespace Modules\KMNSSupportWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\KMNSSupportWidget\Models\KmnsSupportWidgetLifeActivityType;
use Modules\KMNSSupportWidget\Services\KMNSSupportWidgetService;
use Modules\KMNSSupportWidget\Swagger\Docs\Attributes\GetActivityTypes;
use Modules\KMNSSupportWidget\Swagger\Docs\Attributes\GetMeasures;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'KMNSSupportWidget', description: 'Виджет "Меры поддержки КМНС"')]
class KMNSSupportWidgetController extends Controller
{
    private KMNSSupportWidgetService $KMNSSupportWidgetService;

    /**
     * @param KMNSSupportWidgetService $KMNSSupportWidgetService
     */
    public function __construct(KMNSSupportWidgetService $KMNSSupportWidgetService)
    {
        $this->KMNSSupportWidgetService = $KMNSSupportWidgetService;
        Context::add('module', 'KMNSSupportWidget');

    }

    #[GetActivityTypes]
    public function getActivityTypes()
    {
        return KmnsSupportWidgetLifeActivityType::all();
    }

    #[GetMeasures]
    public function getMeasures(Request $request)
    {
        $validated = $request->validate([
            'activity_type_id' => 'sometimes|exists:kmns_support_widget_life_activity_types,id',
            'name' => 'sometimes|nullable|string',
        ]);
        return $this->KMNSSupportWidgetService->getMeasures($validated['name'] ?? null, $validated['activity_type_id'] ?? null);
    }
}
