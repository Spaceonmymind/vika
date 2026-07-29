<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers\Trainers;

use Modules\SportSectionsWidget\Models\Trainer;
use Modules\SportSectionsWidget\OpenDataHandlers\TrainersSourceHandler;

class BerezovskySourceHandler extends TrainersSourceHandler
{

    protected const array FIELDS = [
        'F_I_O__TRENERA',
        'KONTAKTNYY_TELEFON',
        'SPORTIVNYY_RAZRYAD_ZVANIE',

        //Не используемые
        'SUBEKT_ROSSIYSKOY_FEDERATSII',
        'MUNITSIPALNOE_OBRAZOVANIE',
        '',
    ];

    #[\Override]
    protected static function handleRowData(array $row, int $municipalityId): void
    {
        $row = $row['cols'];

        $attributes = [
            'name' => $row['F_I_O__TRENERA'],
            'phone' => $row['KONTAKTNYY_TELEFON'],
            'category' => $row['SPORTIVNYY_RAZRYAD_ZVANIE'],
            'municipality_id' => $municipalityId,
        ];
        self::createModelWithTrimAttributes(new Trainer, $attributes);
    }
}
