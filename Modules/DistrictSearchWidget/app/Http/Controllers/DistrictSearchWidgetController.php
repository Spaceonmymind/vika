<?php

namespace Modules\DistrictSearchWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\DistrictSearchWidget\Services\DistrictSearchService;
use Modules\DistrictSearchWidget\Swagger\Docs\Attributes\GetDistricts;
use Modules\DistrictSearchWidget\Swagger\Docs\Attributes\GetStreets;
use Modules\DistrictSearchWidget\Swagger\Docs\Attributes\GetDistrictCities;
use OpenApi\Attributes as OA;


#[OA\Tag(name: 'DistrictSearchWidget', description: 'Виджет поиска медицинских участков')]
class DistrictSearchWidgetController extends Controller
{
    private DistrictSearchService $districtSearchService;

    /**
     * @param DistrictSearchService $districtSearchService
     */
    public function __construct(DistrictSearchService $districtSearchService)
    {
        $this->districtSearchService = $districtSearchService;
        Context::add('module', 'DistrictSearchWidget');

    }

    #[GetDistrictCities]
    public function getCities(Request $request)
    {
        return $this->districtSearchService->getCities();
    }


    #[GetStreets]
    public function getStreets(Request $request)
    {
        $validated = $request->validate([
            'city_id' => 'required|exists:district_search_widget_cities,id',
        ]);

        return $this->districtSearchService->getStreets($validated['city_id']);
    }

    #[GetDistricts]
    public function getDistricts(Request $request)
    {
        $validated = $request->validate([
            'street_id' => 'required|exists:district_search_widget_streets,id',
            'house_number' => 'required|string',
        ]);
        return $this->districtSearchService->getDistricts($validated['street_id'], $validated['house_number']);
    }
}
