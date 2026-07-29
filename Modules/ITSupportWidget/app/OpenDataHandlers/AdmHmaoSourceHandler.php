<?php

namespace Modules\ITSupportWidget\OpenDataHandlers;

use Modules\ITSupportWidget\Models\ItSupportWidgetMeasure;
use Modules\ITSupportWidget\Models\ItSupportWidgetOdDataset;

class AdmHmaoSourceHandler extends AbstractSourceHandler
{

    protected const array FIELDS = [
        'N',
        'VID_MERY',
        'NAIMENOVANIE_MERY_PODDERZHKI',
        'USLOVIYA_POLUCHENIYA_PODDERZHKI_POLUCHAT',
        'SROKI_OKAZANIYA_PODDERZHKI',
        'OTVESTVENNYE'
    ];

    public static function processData(array $data, ItSupportWidgetOdDataset $dataset): void
    {

        $rows = $data['rows'];

        foreach ($rows as $row) {

            ItSupportWidgetMeasure::query()->create([
                'name' => trim($row['cols']['NAIMENOVANIE_MERY_PODDERZHKI']),
                'type' => static::prepareString($row['cols']['VID_MERY']),
                'conditions' => static::prepareString($row['cols']['USLOVIYA_POLUCHENIYA_PODDERZHKI_POLUCHAT']),
                'terms' => static::prepareString($row['cols']['SROKI_OKAZANIYA_PODDERZHKI']),
                'responsible' => static::prepareString($row['cols']['OTVESTVENNYE']),
            ]);

            self::$rowNumber++;
        }
    }
}
