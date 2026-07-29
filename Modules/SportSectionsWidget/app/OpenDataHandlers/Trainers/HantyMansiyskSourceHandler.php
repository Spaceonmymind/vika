<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers\Trainers;

use Modules\SportSectionsWidget\Models\Trainer;
use Modules\SportSectionsWidget\OpenDataHandlers\TrainersSourceHandler;

class HantyMansiyskSourceHandler extends TrainersSourceHandler
{

    protected const array FIELDS = [
        'FIO_TRENERA',
        'KONTAKTNYY_TELEFON',
        'SPORTIVNYY_RAZRYAD',

        //Не используемые
        'IDENTIFIKATOR_SPORTIVNOY_ORGANIZATSII',
        '',
    ];

    #[\Override]
    protected static function handleRowData(array $row, int $municipalityId): void
    {
        $row = $row['cols'];

        $attributes = [
            'name' => $row['FIO_TRENERA'],
            'phone' => $row['KONTAKTNYY_TELEFON'],
            'category' => $row['SPORTIVNYY_RAZRYAD'],
            'municipality_id' => $municipalityId,
        ];

        self::createModelWithTrimAttributes(new Trainer, $attributes);
    }

}
