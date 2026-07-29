<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers\Organisations;

use Modules\SportSectionsWidget\Models\OdDataset;
use Modules\SportSectionsWidget\Models\Organisation;
use Modules\SportSectionsWidget\OpenDataHandlers\OrganisationsSourceHandler;

class SurgutDistrictSourceHandler extends OrganisationsSourceHandler
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
        'subektrossiyskoyfederacii',
        'municipalnoeobrazovanierayon',
        'vidobektafizicheskoykulturyisporta',
        'nazvaniesportivnoyzony',
        'harakteristikasportivnoyzonyprinalichii',
        'adres',
        'platnostispolzovaniya',
        'vozmojnostprokatainventarya',
        'grafikraboty',
        'prisposoblennostdlyainvalidoviililicsogr',
        'telefondlyaspravok',
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
}
