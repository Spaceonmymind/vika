<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers\Trainers;

use Modules\SportSectionsWidget\OpenDataHandlers\TrainersSourceHandler;

class PokachiSourceHandler extends TrainersSourceHandler
{

    protected const array FIELDS = [
        'FIO_TRENERA',
        'KONTAKTNYY_TELEFON',
        'SPORTIVNYY_RAZRYAD_ZVANIE',

        //Не используемые
        'PORYADKOVYY_NOMER',
    ];
}
