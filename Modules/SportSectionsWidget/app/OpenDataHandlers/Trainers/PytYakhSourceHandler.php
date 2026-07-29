<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers\Trainers;

use Modules\SportSectionsWidget\Models\Trainer;
use Modules\SportSectionsWidget\OpenDataHandlers\TrainersSourceHandler;

class PytYakhSourceHandler extends TrainersSourceHandler
{
    protected const array FIELDS = [
        'COLUMN_1',
        'COLUMN_2',
        'COLUMN_3',

        //Не используемые
        'COLUMN_0',
    ];

    #[\Override]
    protected static function handleRowData(array $row, int $municipalityId): void
    {
        $row = $row['cols'];

        $attributes = [
            'name' => $row['COLUMN_1'],
            'phone' => $row['COLUMN_2'],
            'category' => $row['COLUMN_3'],
            'municipality_id' => $municipalityId,
        ];

        self::createModelWithTrimAttributes(new Trainer, $attributes);
    }
}
