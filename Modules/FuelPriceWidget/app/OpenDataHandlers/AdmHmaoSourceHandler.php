<?php

namespace Modules\FuelPriceWidget\OpenDataHandlers;

use Modules\FuelPriceWidget\Constants\FuelTypes;
use Modules\FuelPriceWidget\Helpers\CoordinatesHelper;
use Modules\FuelPriceWidget\Helpers\PriceHelper;
use Modules\FuelPriceWidget\Models\FuelPrice;
use Modules\FuelPriceWidget\Models\GasStation;
use Modules\FuelPriceWidget\Models\OdDataset;

class AdmHmaoSourceHandler extends AbstractSourceHandler
{

    protected const array FIELDS = [
        'NAME_OF_THE_FILLING_STATION',
        'BUSINESS_NAME',
        'ADDRESS',
        'SHIROTA',
        'DOLGOTA',
        'AI92',
        'AI95',
        'AI98',
        'AI100',
        'GAZ_BUTAN',
        'GAZ_PROPAN',
        'DT',
        'METAN',

        //Не используемые
        'P_P',
    ];

    public static function processData(array $data, OdDataset $dataset): void
    {
        $rows = $data['rows'];

        foreach ($rows as $row) {
            $gasStation = GasStation::query()->create(
                [
                    'name' => $row['cols']['NAME_OF_THE_FILLING_STATION'],
                    'company_name' => $row['cols']['BUSINESS_NAME'],
                    'address' => $row['cols']['ADDRESS'],
                    'latitude' => CoordinatesHelper::prepareCoordinate($row['cols']['SHIROTA']),
                    'longitude' => CoordinatesHelper::prepareCoordinate($row['cols']['DOLGOTA']),
                    'od_api_id' => $dataset->id,
                    'city_id' => $dataset->city_id,
                ]
            );

            $fuelPrices = [
                [
                    'gas_station_id' => $gasStation->id,
                    'fuel_type_id' => FuelTypes::AI92->value,
                    'price' => $row['cols']['AI92'] ?? null,
                ],
                [
                    'gas_station_id' => $gasStation->id,
                    'fuel_type_id' => FuelTypes::AI95->value,
                    'price' => $row['cols']['AI95'] ?? null,
                ],
                [
                    'gas_station_id' => $gasStation->id,
                    'fuel_type_id' => FuelTypes::AI98->value,
                    'price' => $row['cols']['AI98'] ?? null,
                ],
                [
                    'gas_station_id' => $gasStation->id,
                    'fuel_type_id' => FuelTypes::AI100->value,
                    'price' => $row['cols']['AI100'] ?? null,
                ],
                [
                    'gas_station_id' => $gasStation->id,
                    'fuel_type_id' => FuelTypes::BUTANE->value,
                    'price' => $row['cols']['GAZ_BUTAN'] ?? null,
                ],
                [
                    'gas_station_id' => $gasStation->id,
                    'fuel_type_id' => FuelTypes::PROPANE->value,
                    'price' => $row['cols']['GAZ_PROPAN'] ?? null,
                ],
                [
                    'gas_station_id' => $gasStation->id,
                    'fuel_type_id' => FuelTypes::DIESEL->value,
                    'price' => $row['cols']['DT'] ?? null,
                ],
                [
                    'gas_station_id' => $gasStation->id,
                    'fuel_type_id' => FuelTypes::METHANE->value,
                    'price' => $row['cols']['METAN'] ?? null,
                ]
            ];

            $prepareData = array_map(function ($row) {
                $row['price'] = PriceHelper::preparePrice($row['price']);
                return $row;
            }, $fuelPrices);

            FuelPrice::query()
                ->insert($prepareData);

            self::$rowNumber++;
        }
    }
}
