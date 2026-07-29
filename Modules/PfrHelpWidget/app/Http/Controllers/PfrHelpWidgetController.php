<?php

namespace Modules\PfrHelpWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\PfrHelpWidget\Services\PfrHelpWidgetService;
use Modules\PfrHelpWidget\Swagger\Docs\Attributes\GetCategories;
use Modules\PfrHelpWidget\Swagger\Docs\Attributes\GetQuestions;
use Modules\PfrHelpWidget\Swagger\Docs\Attributes\GetServices;
use OpenApi\Attributes as OA;


#[OA\Tag(name: 'PfrHelpWidget', description: 'Виджет "Меры государственной поддержки родителей"')]
class PfrHelpWidgetController extends Controller
{
    private PfrHelpWidgetService $pfrHelpWidgetService;

    /**
     * @param PfrHelpWidgetService $pfrHelpWidgetService
     */
    public function __construct(PfrHelpWidgetService $pfrHelpWidgetService)
    {
        $this->pfrHelpWidgetService = $pfrHelpWidgetService;
        Context::add('module', 'PfrHelpWidget');

    }

    #[GetServices]
    public function getServices(Request $request)
    {
        return $this->pfrHelpWidgetService->getServices();
    }

    #[GetCategories]
    public function getCategories(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'sometimes',
        ]);
        return $this->pfrHelpWidgetService->getCategories($validated['service_id'] ?? null);
    }

    #[GetQuestions]
    public function getQuestions(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'sometimes',
            'category_id' => 'sometimes',
        ]);
        return $this->pfrHelpWidgetService->getQuestions($validated['category_id'] ?? null, $validated['service_id'] ?? null);
    }
}
