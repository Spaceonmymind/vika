<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers\Sections;

use Modules\SportSectionsWidget\OpenDataHandlers\SectionsSourceHandler;

class NefteuganskSourceHandler extends SectionsSourceHandler
{

    protected const array FIELDS = [
        'IDENTIFIKATOR_SPORTIVNOY_ORGANIZATSII',
        'NAZVANIE_SEKTSII',
        'VOZRASTNYE_OGRANICHENIYA',
        'FIO_TRENERA',
        'NASELENNYY_PUNKT',
        'ULITSA',
        'DOM',
        'PONEDELNIK',
        'VTORNIK',
        'SREDA',
        'CHETVERG',
        'PYATNITSA',
        'SUBBOTA',
        'VOSKRESENE',

        //Не используемые
        '_P_P',
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
            'PONEDELNIK' => 'WORK_TIME_MON',
            'VTORNIK' => 'WORK_TIME_TUE',
            'SREDA' => 'WORK_TIME_WED',
            'CHETVERG' => 'WORK_TIME_THU',
            'PYATNITSA' => 'WORK_TIME_FRI',
            'SUBBOTA' => 'WORK_TIME_SAT',
            'VOSKRESENE' => 'WORK_TIME_SUN',
        ];
    }
}
