<?php

namespace Modules\CultureUgraWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\CultureUgraWidget\Models\CultureUgraWidgetLocality;
use Modules\CultureUgraWidget\Services\CultureUgraWidgetService;
use Modules\CultureUgraWidget\Swagger\Docs\Attributes\GetEvents;
use Modules\CultureUgraWidget\Swagger\Docs\Attributes\GetLocalities;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'CultureUgraWidget', description: 'Виджет "Культура Югры"')]
class CultureUgraWidgetController extends Controller
{
    private CultureUgraWidgetService $cultureUgraWidgetService;

    /**
     * @param CultureUgraWidgetService $cultureUgraWidgetService
     */
    public function __construct(CultureUgraWidgetService $cultureUgraWidgetService)
    {
        $this->cultureUgraWidgetService = $cultureUgraWidgetService;
        Context::add('module', 'CultureUgraWidget');

    }

    #[GetLocalities]
    public function getLocalities(Request $request)
    {
        return CultureUgraWidgetLocality::query()
            ->whereHas('culture_ugra_widget_events')
            ->get();
    }

    #[GetEvents]
    public function getCultureEvents(Request $request)
    {
        $validated = $request->validate([
            'locality_id' => 'sometimes|integer|nullable|exists:culture_ugra_widget_localities,id',
        ]);
        return $this->cultureUgraWidgetService->getEvents($validated['locality_id'] ?? null);
    }
}
