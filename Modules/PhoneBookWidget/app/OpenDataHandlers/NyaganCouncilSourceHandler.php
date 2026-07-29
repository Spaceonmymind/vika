<?php

namespace Modules\PhoneBookWidget\OpenDataHandlers;

use Modules\PhoneBookWidget\Models\OdDataset;
use Modules\PhoneBookWidget\Models\PhonebookRecord;

class NyaganCouncilSourceHandler extends AbstractSourceHandler
{
    protected const array FIELDS = [
        'F_I_O_',
        'TELEFON',
        'DOLZHNOST',

        //Не используемые
        '_KABINETA',
    ];

    protected static function processData(array $data, OdDataset $dataset): void
    {
        $rows = $data['rows'];

        foreach ($rows as $row) {
            self::$rowNumber++;

            PhonebookRecord::query()
                ->insert([
                    'fio' => $row['cols']['F_I_O_'],
                    'post' => $row['cols']['DOLZHNOST'] ?? null,
                    'phone' => $row['cols']['TELEFON'] ?? null,
                    'od_api_id' => $dataset->id,
                ]);

            self::$rowNumber++;
        }
    }
}
