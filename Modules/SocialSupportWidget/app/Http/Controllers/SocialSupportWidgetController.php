<?php

namespace Modules\SocialSupportWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\SocialSupportWidget\Services\SocialSupportWidgetService;
use Modules\SocialSupportWidget\Swagger\Docs\Attributes\GetMeasures;
use Modules\SocialSupportWidget\Swagger\Docs\Attributes\GetPreferentialCategories;
use Modules\SocialSupportWidget\Swagger\Docs\Attributes\GetSituations;
use OpenApi\Attributes as OA;


#[OA\Tag(name: 'SocialSupportWidget', description: 'Виджет "Меры социальной поддержки"')]
class SocialSupportWidgetController extends Controller
{
    private SocialSupportWidgetService $socialSupportWidgetService;

    /**
     * @param SocialSupportWidgetService $socialSupportWidgetService
     */
    public function __construct(SocialSupportWidgetService $socialSupportWidgetService)
    {
        $this->socialSupportWidgetService = $socialSupportWidgetService;
        Context::add('module', 'SocialSupportWidget');

    }

    #[GetPreferentialCategories]
    public function getPreferentialCategories(Request $request)
    {
        return $this->socialSupportWidgetService->getPreferentialCategories();
    }

    #[GetSituations]
    public function getSituations(Request $request)
    {
        return $this->socialSupportWidgetService->getSituations();
    }

    #[GetMeasures]
    public function getMeasures(Request $request)
    {
        $validated = $request->validate([
            'situation_id' => 'sometimes|nullable|integer|exists:social_support_widget_situations,id',
            'preferential_categories' => 'sometimes|array',
            'date_relocation' => 'sometimes|nullable|date',
            'child_birthday' => 'sometimes|nullable|date',
            'income' => 'sometimes|nullable|integer',
            'family_members_count' => 'sometimes|nullable|integer',
        ]);
        return $this->socialSupportWidgetService->getMeasures($validated);
    }
}
