<?php

namespace Modules\DistrictSearchWidget\OpenDataHandlers;

use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetCity;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetHospital;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetOdDataset;

class HospitalsSourceHandler extends AbstractSourceHandler
{
    protected const array FIELDS = [
        'UCHREZHDENIE',
        'NASELENNYY_PUNKT_NAIMENOVANIE_NASELENNOG',
        'ULITSA',
        'DOM_DOM_V_FORMATE_DOMA_STROENIYA',
        'VEB_SAYT',
        'E_MAIL',
        'KONTAKTNYY_TELEFON_FORMAT_7_KHKHKHKH_KHK',

        //Не используемые
        'INN',
    ];

    protected static function processData(array $data, DistrictSearchWidgetOdDataset $dataset): void
    {
        $rows = $data['rows'];

        foreach ($rows as $row) {

            $city = DistrictSearchWidgetCity::query()
                ->firstOrCreate([
                    'name' => $row['cols']['NASELENNYY_PUNKT_NAIMENOVANIE_NASELENNOG'],
                ],[]);

            $address =
                $row['cols']['NASELENNYY_PUNKT_NAIMENOVANIE_NASELENNOG'] . ', ' .
                $row['cols']['ULITSA'] . ', ' .
                $row['cols']['DOM_DOM_V_FORMATE_DOMA_STROENIYA'];

            DistrictSearchWidgetHospital::query()->updateOrCreate([
                'name' => $row['cols']['UCHREZHDENIE'],
            ], [
                'name' => $row['cols']['UCHREZHDENIE'],
                'address' => $address,
                'site' => $row['cols']['VEB_SAYT'],
                'email' => $row['cols']['E_MAIL'],
                'phone' => $row['cols']['KONTAKTNYY_TELEFON_FORMAT_7_KHKHKHKH_KHK'],
                'city_id' => $city->id,
            ]);

            self::$rowNumber++;
        }
    }


}
