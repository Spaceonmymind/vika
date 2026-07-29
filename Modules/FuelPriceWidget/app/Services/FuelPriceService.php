<?php

namespace Modules\FuelPriceWidget\Services;


use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\FuelPriceWidget\Models\GasStation;

class FuelPriceService
{
    /**
     * Получить цены в указанном городе на указанные виды топлива
     * @param int $cityId
     * @param array $fuelTypesIds
     * @return Collection
     */
    public function getFuelPricesInCity(int $cityId, array $fuelTypesIds): Collection
    {
        return GasStation::query()
            ->where('city_id', $cityId)
            ->with([
                'fuel_prices' => function (Builder $q) use ($fuelTypesIds) {
                    $q
                        ->when(!empty($fuelTypesIds), function ($q) use ($fuelTypesIds) {
                            $q->whereIn('fuel_type_id', $fuelTypesIds);
                        })
                        ->whereNotNull('price');
                },
                'fuel_prices.fuel_type',
            ])
            ->whereHas('fuel_prices', function (Builder $q) use ($fuelTypesIds) {

                $q
                    ->when(!empty($fuelTypesIds), function (Builder $q) use ($fuelTypesIds) {
                        $q->whereIn('fuel_type_id', $fuelTypesIds);
                    })
                    ->whereNotNull('price');

            })
            ->get();
    }
}
