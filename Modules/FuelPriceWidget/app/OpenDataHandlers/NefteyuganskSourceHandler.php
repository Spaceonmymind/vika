<?php

namespace Modules\FuelPriceWidget\OpenDataHandlers;

class NefteyuganskSourceHandler extends AdmHmaoSourceHandler
{
    protected const array FIELDS = [
        'NAME_OF_THE_FILLING_STATION',
        'BUSINESS_NAME',
        'ADDRESS',
        'SHIROTA',
        'DOLGOTA',
        'AI92',
        'AI95',
        'AI98',
        'AI100',
        'GAZ_BUTAN',
        'GAZ_PROPAN',
        'DT',

        //Не используемые
        'P_P',
    ];
}
