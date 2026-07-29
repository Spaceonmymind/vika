<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers\Organisations;

use Modules\SportSectionsWidget\Models\OdDataset;
use Modules\SportSectionsWidget\Models\Organisation;
use Modules\SportSectionsWidget\OpenDataHandlers\OrganisationsSourceHandler;

class HantyMansiyskSourceHandler extends OrganisationsSourceHandler
{

    protected const array FIELDS = [
        'NAZVANIE_ORGANIZATSII',
        'NASELENNYY_PUNKT',
        'ULITSA',
        'DOM',
        'INN',
        'SAYT',
        'EL_POCHTA',
        'TELEFON',

        //Не используемые
        '',
    ];

    public static function processData(array $data, OdDataset $dataset): void
    {
        $rows = $data['rows'];
        $municipalityId = $dataset->municipality_id;
        Organisation::query()->where('municipality_id', $municipalityId)->delete();

        foreach ($rows as $row) {
            $row = $row['cols'];
            $cityId = self::getCityId($row['NASELENNYY_PUNKT'], $municipalityId);

            Organisation::query()->create([
                'name' => $row['NAZVANIE_ORGANIZATSII'],
                'city_id' => $cityId,
                'street' => $row['ULITSA'],
                'house' => $row['DOM'],
                'inn' => $row['INN'],
                'site' => $row['SAYT'],
                'email' => $row['EL_POCHTA'],
                'phone' => $row['TELEFON'],
                'municipality_id' => $municipalityId,
            ]);
            self::$rowNumber++;
        }
    }
}
