<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers\Trainers;

use Modules\SportSectionsWidget\Models\Trainer;
use Modules\SportSectionsWidget\OpenDataHandlers\TrainersSourceHandler;

class OktyabrskyDistrictSourceHandler extends TrainersSourceHandler
{

    protected const array FIELDS = [
        'COACH_NAME_FIO_TRENERA',
        'PHONE_KONTAKTNYY_TELEFON_FORMAT_7_KHKHKH',
        'SPORT_LEVEL_SPORTIVNYY_RAZRYAD_ZVANIE',

        //Не используемые
        'ID_PORYADKOVYY_NOMER',
    ];

    #[\Override]
    protected static function handleRowData(array $row, int $municipalityId): void
    {
        $row = $row['cols'];

        $attributes = [
            'name' => $row['COACH_NAME_FIO_TRENERA'],
            'phone' => $row['PHONE_KONTAKTNYY_TELEFON_FORMAT_7_KHKHKH'],
            'category' => $row['SPORT_LEVEL_SPORTIVNYY_RAZRYAD_ZVANIE'],
            'municipality_id' => $municipalityId,
        ];

        self::createModelWithTrimAttributes(new Trainer, $attributes);
    }
}
