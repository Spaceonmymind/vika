<?php

namespace Modules\PhoneBookWidget\OpenDataHandlers;

use Modules\PhoneBookWidget\Models\OdDataset;
use Modules\PhoneBookWidget\Models\PhonebookRecord;

class NizhnevartovskDistrictSourceHandler extends AbstractSourceHandler
{
    protected const array FIELDS = [
        'FIO',
        'NASELENNYY_PUNKT',
        'KONTAKTNYY_TELEFON',
        'E_MAIL',
        'DOLZHNOST',
        'NAIMENOVANIE_ORGANA_VLASTI',
        'UPRAVLENIE_OTDEL',
        'NASELENNYY_PUNKT',
        'ULITSA',
        'DOM',

        //Не используемые
        'KABINET',
        'SAYT',
        'NAIMENOVANIE_GEOOBEKTA',
        'DOSTUPNOST_DLYA_MALOMOBILNYKH_GRUPP_NASE',
    ];

    protected static function processData(array $data, OdDataset $dataset): void
    {
        $rows = $data['rows'];

        foreach ($rows as $row) {

            $address =
                $row['cols']['NASELENNYY_PUNKT'] . ', ' .
                $row['cols']['ULITSA'] . ', ' .
                $row['cols']['DOM'];

            PhonebookRecord::query()
                ->insert([
                    'fio' => $row['cols']['FIO'],
                    'city' => $row['cols']['NASELENNYY_PUNKT'] ?? null,
                    'phone' => $row['cols']['KONTAKTNYY_TELEFON'] ?? null,
                    'email' => $row['cols']['E_MAIL'] ?? null,
                    'address' => $address,
                    'post' => $row['cols']['DOLZHNOST'] ?? null,
                    'administration_body_name' => $row['cols']['NAIMENOVANIE_ORGANA_VLASTI'] ?? null,
                    'management_department' => $row['cols']['UPRAVLENIE_OTDEL'] ?? null,
                    'od_api_id' => $dataset->id,
                ]);

            self::$rowNumber++;
        }
    }




}
