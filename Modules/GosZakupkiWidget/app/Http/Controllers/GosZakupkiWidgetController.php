<?php

namespace Modules\GosZakupkiWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\GosZakupkiWidget\Models\GosZakupkiWidgetQuestionCategory;
use Modules\GosZakupkiWidget\Services\GosZakupkiWidgetService;
use Modules\GosZakupkiWidget\Swagger\Docs\Attributes\GetQuestionCategories;
use Modules\GosZakupkiWidget\Swagger\Docs\Attributes\GetQuestions;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'GosZakupkiWidget', description: 'Виджет "госзакупки Югры"')]
class GosZakupkiWidgetController extends Controller
{
    private GosZakupkiWidgetService $gosZakupkiWidgetService;

    public function __construct(GosZakupkiWidgetService $gosZakupkiWidgetService)
    {
        $this->gosZakupkiWidgetService = $gosZakupkiWidgetService;
        Context::add('module', 'GosZakupkiWidget');

    }

    #[GetQuestionCategories]
    public function getQuestionCategories(Request $request)
    {
        return GosZakupkiWidgetQuestionCategory::all();
    }

    #[GetQuestions]
    public function getQuestions(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'sometimes|integer|nullable|exists:gos_zakupki_widget_question_categories,id',
        ]);

        return $this->gosZakupkiWidgetService->getQuestions($validated['category_id'] ?? null);
    }
}
