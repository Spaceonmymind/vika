<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers\Trainers;

use Modules\SportSectionsWidget\Models\Trainer;
use Modules\SportSectionsWidget\OpenDataHandlers\TrainersSourceHandler;

class LangepasSourceHandler extends TrainersSourceHandler
{

    protected const array FIELDS = [
        'COACH_NAME',
        'PHONE',
        'SPORT_LEVEL',

        //Не используемые
    ];

    #[\Override]
    protected static function handleRowData(array $row, int $municipalityId): void
    {
        $row = $row['cols'];

        $attributes = [
            'name' => $row['COACH_NAME'],
            'phone' => $row['PHONE'],
            'category' => $row['SPORT_LEVEL'],
            'municipality_id' => $municipalityId,
        ];

        self::createModelWithTrimAttributes(new Trainer, $attributes);
    }


}
