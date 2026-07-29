<?php

namespace Modules\BusinessSupportWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetRegistrationPlace;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetSituation;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetSubject;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetSupportOrganisation;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetSupportType;
use Modules\BusinessSupportWidget\Services\BusinessSupportWidgetService;
use Modules\BusinessSupportWidget\Swagger\Docs\Attributes\GetRegistrationPlaces;
use Modules\BusinessSupportWidget\Swagger\Docs\Attributes\GetSituations;
use Modules\BusinessSupportWidget\Swagger\Docs\Attributes\GetSubjects;
use Modules\BusinessSupportWidget\Swagger\Docs\Attributes\GetSupportMeasures;
use Modules\BusinessSupportWidget\Swagger\Docs\Attributes\GetSupportOrganisations;
use Modules\BusinessSupportWidget\Swagger\Docs\Attributes\GetSupportTypes;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'BusinessSupportWidget', description: 'Виджет поиска мер поддержки предпринимателей')]
class BusinessSupportWidgetController extends Controller
{
    private BusinessSupportWidgetService $businessSupportWidgetService;

    /**
     * @param BusinessSupportWidgetService $businessSupportWidgetService
     */
    public function __construct(BusinessSupportWidgetService $businessSupportWidgetService)
    {
        $this->businessSupportWidgetService = $businessSupportWidgetService;
        Context::add('module', 'BusinessSupportWidget');

    }

    #[GetRegistrationPlaces]
    public function getRegistrationPlaces(Request $request)
    {
        return BusinessSupportWidgetRegistrationPlace::query()
            ->whereHas('business_support_widget_measures')
            ->get();
    }

    #[GetSituations]
    public function getSituations(Request $request)
    {
        return BusinessSupportWidgetSituation::query()
            ->whereHas('business_support_widget_measures')
            ->get();
    }

    #[GetSubjects]
    public function getSubjects(Request $request)
    {
        return BusinessSupportWidgetSubject::query()
            ->whereHas('business_support_widget_measures')
            ->get();
    }

    #[GetSupportOrganisations]
    public function getSupportOrganisations(Request $request)
    {
        return BusinessSupportWidgetSupportOrganisation::query()
            ->whereHas('business_support_widget_measures')
            ->get();
    }

    #[GetSupportTypes]
    public function getSupportTypes(Request $request)
    {
        return BusinessSupportWidgetSupportType::query()
            ->whereHas('business_support_widget_measures')
            ->get();
    }

    #[GetSupportMeasures]
    public function getMeasures(Request $request)
    {
        $validated = $request->validate([
            'situation_id' => 'sometimes|integer|nullable|exists:business_support_widget_situations,id',
            'subject_id' => 'sometimes|integer|nullable|exists:business_support_widget_subjects,id',
            'registration_place_id' => 'sometimes|integer|nullable|exists:business_support_widget_registration_places,id',
            'support_organisation_id' => 'sometimes|integer|nullable|exists:business_support_widget_support_organisations,id',
            'support_type_id' => 'sometimes|integer|nullable|exists:business_support_widget_support_types,id',
        ]);
        return $this->businessSupportWidgetService->getMeasures($validated);
    }
}
