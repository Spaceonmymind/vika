<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers\Trainers;

use Modules\SportSectionsWidget\Models\Trainer;
use Modules\SportSectionsWidget\OpenDataHandlers\TrainersSourceHandler;

class MegionSourceHandler extends TrainersSourceHandler
{

    protected const array FIELDS = [
        'coach_name',
        'phone',
        'sport_level',

        //Не используемые
        'p_p',
        'inn',
    ];

    #[\Override]
    protected static function handleRowData(array $row, int $municipalityId): void
    {
        $row = $row['cols'];

        $attributes = [
            'name' => $row['coach_name'],
            'phone' => $row['phone'],
            'category' => $row['sport_level'],
            'municipality_id' => $municipalityId,
        ];

        self::createModelWithTrimAttributes(new Trainer, $attributes);
    }


}
