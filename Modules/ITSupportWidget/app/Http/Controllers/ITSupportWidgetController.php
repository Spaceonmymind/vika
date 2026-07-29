<?php

namespace Modules\ITSupportWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\ITSupportWidget\Services\ITSupportWidgetService;
use Modules\ITSupportWidget\Swagger\Docs\Attributes\GetMeasures;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'ITSupportWidget', description: 'Виджет "Меры поддержки it"')]
class ITSupportWidgetController extends Controller
{
    private ITSupportWidgetService $iTSupportWidgetService;

    /**
     * @param ITSupportWidgetService $iTSupportWidgetService
     */
    public function __construct(ITSupportWidgetService $iTSupportWidgetService)
    {
        $this->iTSupportWidgetService = $iTSupportWidgetService;
        Context::add('module', 'ITSupportWidget');

    }

    #[GetMeasures]
    public function getMeasures(Request $request)
    {
        $validated = $request->validate([
            'name' => 'sometimes',
        ]);
        return $this->iTSupportWidgetService->getMeasures($validated['name'] ?? null);
    }
}
