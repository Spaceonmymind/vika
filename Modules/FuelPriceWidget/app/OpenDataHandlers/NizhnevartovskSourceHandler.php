<?php

namespace Modules\FuelPriceWidget\OpenDataHandlers;

use Illuminate\Support\Facades\Http;
use Modules\FuelPriceWidget\Constants\FuelTypes;
use Modules\FuelPriceWidget\Helpers\CoordinatesHelper;
use Modules\FuelPriceWidget\Helpers\PriceHelper;
use Modules\FuelPriceWidget\Models\FuelPrice;
use Modules\FuelPriceWidget\Models\GasStation;
use Modules\FuelPriceWidget\Models\OdDataset;

class NizhnevartovskSourceHandler extends AbstractSourceHandler
{
    protected const array FIELDS = [
        'AZS_LD',
        'AI92',
        'AI95',
        'AI98',
        'DTZIMA',
        'ECTO100',

        //Не используемые
        'AZS',
        'DAT',
        'AI95EURO',
        'GDRIVEAI95',
        'DTLETO',
        'DTARTIK',
        'GAZ',
        'AI80',
    ];

    public static function processData(array $data, OdDataset $dataset): void
    {
        $rows = $data['RESULT']['ROWS'];

        foreach ($rows as $row) {
            $companyInfo = Http::get($row['AZS_LD'] . '&api_key=APP-VIKA_admhmao.ru');

            if (!$companyInfo->ok() || empty($companyInfo->body())) {
                throw new \Exception('Ошибка получения информации о владельце АЗС');
            }

            $companyInfo = $companyInfo->json()['RESULT']['ROWS'][0];

            $gasStation = GasStation::query()->create(
                [
                    'name' => $companyInfo['NUM'],
                    'company_name' => $companyInfo['ORG'],
                    'address' => $companyInfo['ADDRESS'],
                    'latitude' => CoordinatesHelper::prepareCoordinate($companyInfo['LAT']),
                    'longitude' => CoordinatesHelper::prepareCoordinate($companyInfo['LON']),
                    'od_api_id' => $dataset->id,
                    'city_id' => $dataset->city_id,
                ]
            );

            $fuelPrices = [
                [
                    'gas_station_id' => $gasStation->id,
                    'fuel_type_id' => FuelTypes::AI92->value,
                    'price' => $row['AI92'] ?? null,
                ],
                [
                    'gas_station_id' => $gasStation->id,
                    'fuel_type_id' => FuelTypes::AI95->value,
                    'price' => $row['AI95'] ?? null,
                ],
                [
                    'gas_station_id' => $gasStation->id,
                    'fuel_type_id' => FuelTypes::AI98->value,
                    'price' => $row['AI98'] ?? null,
                ],
                [
                    'gas_station_id' => $gasStation->id,
                    'fuel_type_id' => FuelTypes::AI100->value,
                    'price' => $row['ECTO100'] ?? null,
                ],
//                [
//                    'gas_station_id' => $gasStation->id,
//                    'fuel_type_id' => FuelTypes::BUTANE->value,
//                    'price' => $row['GAZ_BUTAN'] ?? null,
//                ],
//                [
//                    'gas_station_id' => $gasStation->id,
//                    'fuel_type_id' => FuelTypes::PROPANE->value,
//                    'price' => $row['GAZ_PROPAN'] ?? null,
//                ],
                [
                    'gas_station_id' => $gasStation->id,
                    'fuel_type_id' => FuelTypes::DIESEL->value,
                    'price' => $row['DTZIMA'] ?? null,
                ],
//                [
//                    'gas_station_id' => $gasStation->id,
//                    'fuel_type_id' => FuelTypes::METHANE->value,
//                    'price' => $row['METAN'] ?? null,
//                ]
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

    protected static function getColsArray(array $data): array
    {
        return $data['RESULT']['ROWS'][0] ?? [];
    }

    protected static function getValidateRules(): array
    {
        $rules = [
            'RESULT' => 'required|array',
            'RESULT.ROWS' => 'required|array',
        ];

        foreach (static::FIELDS as $field) {
            $rules['RESULT.ROWS.*.' . $field] = 'present|nullable';
        }

        return $rules;
    }
}
