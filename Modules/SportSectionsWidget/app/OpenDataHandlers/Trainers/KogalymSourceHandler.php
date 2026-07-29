<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers\Trainers;

use Modules\SportSectionsWidget\Models\Trainer;
use Modules\SportSectionsWidget\OpenDataHandlers\TrainersSourceHandler;

class KogalymSourceHandler extends TrainersSourceHandler
{

    protected const array FIELDS = [
        'FIO_TRENERA_COACH_NAME',
        'KONTAKTNYY_TELEFON_PHONE',
        'SPORTIVNYY_RAZRYAD_ZVANIE_SPORT_LEVEL',

        //Не используемые
        'PORYADKOVYY_NOMER_ID',
        'IDENTIFIKATOR_SPORTIVNOY_ORGANIZATSII',
    ];

    #[\Override]
    protected static function handleRowData(array $row, int $municipalityId): void
    {
        $row = $row['cols'];

        $attributes = [
            'name' => $row['FIO_TRENERA_COACH_NAME'],
            'phone' => $row['KONTAKTNYY_TELEFON_PHONE'],
            'category' => $row['SPORTIVNYY_RAZRYAD_ZVANIE_SPORT_LEVEL'],
            'municipality_id' => $municipalityId,
        ];

        self::createModelWithTrimAttributes(new Trainer, $attributes);
    }
}
