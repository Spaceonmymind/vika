<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers\Trainers;

use Modules\SportSectionsWidget\OpenDataHandlers\TrainersSourceHandler;

class NefteuganskSourceHandler extends TrainersSourceHandler
{
    protected const array FIELDS = [
        'FIO_TRENERA',
        'KONTAKTNYY_TELEFON',
        'SPORTIVNYY_RAZRYAD_ZVANIE',

        //Не используемые
        'IDENTIFIKATOR_SPORTIVNOY_ORGANIZATSII',
    ];
}
