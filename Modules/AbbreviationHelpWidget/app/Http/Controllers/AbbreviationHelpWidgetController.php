<?php

namespace Modules\AbbreviationHelpWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\AbbreviationHelpWidget\Services\AbbreviationHelpWidgetService;
use Modules\AbbreviationHelpWidget\Swagger\Docs\Attributes\GetAbbreviations;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'AbbreviationHelpWidget', description: 'Виджет "Расшифровка аббревиатур"')]
class AbbreviationHelpWidgetController extends Controller
{
    private AbbreviationHelpWidgetService $abbreviationHelpWidgetService;

    /**
     * @param AbbreviationHelpWidgetService $abbreviationHelpWidgetService
     */
    public function __construct(AbbreviationHelpWidgetService $abbreviationHelpWidgetService)
    {
        $this->abbreviationHelpWidgetService = $abbreviationHelpWidgetService;
        Context::add('module', 'AbbreviationHelpWidget');

    }

    #[GetAbbreviations]
    public function getAbbreviations(Request $request)
    {
        $validated = $request->validate([
            'name' => 'sometimes|nullable|string',
        ]);
        return $this->abbreviationHelpWidgetService->getAbbreviations($validated['name'] ?? null);
    }
}
