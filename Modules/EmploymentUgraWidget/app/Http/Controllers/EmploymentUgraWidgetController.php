<?php

namespace Modules\EmploymentUgraWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\EmploymentUgraWidget\Services\EmploymentUgraWidgetService;
use Modules\EmploymentUgraWidget\Swagger\Docs\Attributes\GetQuestionCategories;
use Modules\EmploymentUgraWidget\Swagger\Docs\Attributes\GetQuestions;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'EmploymentUgraWidget', description: 'Виджет "Занятость в Югре"')]
class EmploymentUgraWidgetController extends Controller
{
    private EmploymentUgraWidgetService $employmentUgraWidgetService;

    /**
     * @param EmploymentUgraWidgetService $employmentUgraWidgetService
     */
    public function __construct(EmploymentUgraWidgetService $employmentUgraWidgetService)
    {
        $this->employmentUgraWidgetService = $employmentUgraWidgetService;
        Context::add('module', 'EmploymentUgraWidget');

    }

    #[GetQuestionCategories]
    public function getCategories(Request $request)
    {
        return $this->employmentUgraWidgetService->getCategories();
    }

    #[GetQuestions]
    public function getQuestions(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'sometimes|nullable|integer|exists:employment_ugra_widget_categories,id',
        ]);

        return $this->employmentUgraWidgetService->getQuestions($validated['category_id'] ?? null);
    }

}
