<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers;

use Modules\SportSectionsWidget\Models\City;
use Modules\SportSectionsWidget\Models\OdDataset;
use Modules\SportSectionsWidget\Models\Organisation;

class OrganisationsSourceHandler extends AbstractSourceHandler
{

    protected const array FIELDS = [
        'ORGANIZATION_NAME',
        'CITY',
        'STREET',
        'HOUSE',
        'INN',
        'SITE',
        'EMAIL',
        'PHONE',

        //Не используемые
        'P_P',
    ];

    public static function processData(array $data, OdDataset $dataset): void
    {
        $rows = $data['rows'];
        $municipalityId = $dataset->municipality_id;
        Organisation::query()->where('municipality_id', $municipalityId)->delete();

        foreach ($rows as $row) {
            $row = $row['cols'];
            $cityId = self::getCityId($row['CITY'], $municipalityId);

            Organisation::query()->create([
                'name' => $row['ORGANIZATION_NAME'],
                'city_id' => $cityId,
                'street' => $row['STREET'],
                'house' => $row['HOUSE'],
                'inn' => $row['INN'],
                'site' => $row['SITE'],
                'email' => $row['EMAIL'],
                'phone' => $row['PHONE'],
                'municipality_id' => $municipalityId,
            ]);
            self::$rowNumber++;
        }
    }

    protected static function getCityId(string $cityName, int $municipalityId): int
    {
        $city = City::query()
            ->firstOrCreate(['name' => $cityName, 'municipality_id' => $municipalityId]);
        return $city->id;
    }
}
