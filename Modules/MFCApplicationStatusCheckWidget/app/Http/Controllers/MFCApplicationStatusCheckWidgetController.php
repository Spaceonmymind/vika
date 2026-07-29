<?php

namespace Modules\MFCApplicationStatusCheckWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\MFCApplicationStatusCheckWidget\Services\MFCApplicationStatusCheckWidgetService;
use Modules\MFCApplicationStatusCheckWidget\Swagger\Docs\Attributes\GetApplicationStatusByNumberOrSnils;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'MFCApplicationStatusCheckWidget', description: 'Виджет "Поиска статуса дела МФЦ"')]
class MFCApplicationStatusCheckWidgetController extends Controller
{
    private MFCApplicationStatusCheckWidgetService $service;

    /**
     * @param MFCApplicationStatusCheckWidgetService $service
     */
    public function __construct(MFCApplicationStatusCheckWidgetService $service)
    {
        $this->service = $service;
        Context::add('module', 'MFCApplicationStatusCheckWidget');

    }

    #[GetApplicationStatusByNumberOrSnils]
    public function getApplicationStatusByNumberOrSnils(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required',
        ]);

        return $this->service->getApplicationStatusByNumberOrSnils($validated['number']);
    }
}
