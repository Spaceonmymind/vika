<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers\Sections;

use Modules\SportSectionsWidget\OpenDataHandlers\SectionsSourceHandler;

class HantyMansiyskSourceHandler extends SectionsSourceHandler
{

    protected const array FIELDS = [
        'IDENTIFIKATOR_SPORTIVNOY_ORGANIZATSII',
        'NAZVANIE_SEKTSII',
        'VOZRASTNYE_OGRANICHENIYA',
        'FIO_TRENERA',
        'NASELENNYY_PUNKT',
        'ULITSA',
        'DOM',
        'PONEDELNIK_VREMYA_RABOTY',
        'VTORNIK_VREMYA_RABOTY',
        'SREDA_VREMYA_RABOTY',
        'CHETVERG_VREMYA_RABOTY',
        'PYATNITSA_VREMYA_RABOTY',
        'SUBBOTA_VREMYA_RABOTY',
        'VOSKRESENE_VREMYA_RABOTY',

        //Не используемые
    ];

    #[\Override]
    protected static function getKeyMappings(): array
    {
        return [
            'IDENTIFIKATOR_SPORTIVNOY_ORGANIZATSII' => 'ID',
            'NAZVANIE_SEKTSII' => 'SECTION_NAME',
            'VOZRASTNYE_OGRANICHENIYA' => 'AGE_LIMIT',
            'FIO_TRENERA' => 'COACH_NAME',
            'NASELENNYY_PUNKT' => 'CITY',
            'ULITSA' => 'STREET',
            'DOM' => 'HOUSE',
            'PONEDELNIK_VREMYA_RABOTY' => 'WORK_TIME_MON',
            'VTORNIK_VREMYA_RABOTY' => 'WORK_TIME_TUE',
            'SREDA_VREMYA_RABOTY' => 'WORK_TIME_WED',
            'CHETVERG_VREMYA_RABOTY' => 'WORK_TIME_THU',
            'PYATNITSA_VREMYA_RABOTY' => 'WORK_TIME_FRI',
            'SUBBOTA_VREMYA_RABOTY' => 'WORK_TIME_SAT',
            'VOSKRESENE_VREMYA_RABOTY' => 'WORK_TIME_SUN',
        ];
    }
}
