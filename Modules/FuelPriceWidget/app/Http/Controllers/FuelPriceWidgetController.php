<?php

namespace Modules\FuelPriceWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\FuelPriceWidget\Models\City;
use Modules\FuelPriceWidget\Models\FuelType;
use Modules\FuelPriceWidget\Services\FuelPriceService;
use Modules\FuelPriceWidget\Swagger\Docs\Attributes\GetCities;
use Modules\FuelPriceWidget\Swagger\Docs\Attributes\GetFuelPricesInCity;
use Modules\FuelPriceWidget\Swagger\Docs\Attributes\GetFuelTypes;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'FuelPriceWidget', description: 'Виджет "Цены на топливо"')]
class FuelPriceWidgetController extends Controller
{
    private FuelPriceService $fuelPriceService;

    public function __construct(FuelPriceService $fuelPriceService)
    {
        $this->fuelPriceService = $fuelPriceService;
        Context::add('module', 'FuelPriceWidget');

    }

    #[GetFuelTypes]
    public function getFuelTypes(Request $request)
    {
        return FuelType::all();
    }

    #[GetCities]
    public function getCities(Request $request)
    {
        return City::query()
            ->orderBy('name', 'asc')
            ->get();
    }

    #[GetFuelPricesInCity]
    public function getFuelPricesInCity(Request $request)
    {
        $validated = $request->validate([
            'city_id' => 'required|exists:fuel_price_widget_cities,id',
            'fuel_type_ids' => 'sometimes|array',
            'fuel_type_ids.*' => 'required|exists:fuel_price_widget_fuel_types,id',
        ]);

        return $this->fuelPriceService->getFuelPricesInCity($validated['city_id'], $validated['fuel_type_ids'] ?? []);
    }
}
