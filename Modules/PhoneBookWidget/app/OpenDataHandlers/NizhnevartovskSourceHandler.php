<?php

namespace Modules\PhoneBookWidget\OpenDataHandlers;

use Modules\PhoneBookWidget\Models\OdDataset;
use Modules\PhoneBookWidget\Models\PhonebookRecord;

class NizhnevartovskSourceHandler extends AbstractSourceHandler
{
    protected const array FIELDS = [
        'FIO',
        'POSITION',
        'PHONE',
        'NAME_GOS.CITY',
        'NAME_GOS.STRUCT_ORG',
        'NAME_GOS.STRUCT_ORG',
        'NAME_GOS.EMAIL',
        'NAME_GOS.CITY',
        'NAME_GOS.ADR',

        //Не используемые
        'GID',
        'NAME_GOS.SID',
        'NAME_GOS.STRUCT_NAME',
        'NAME_GOS.STRUCT_LD',
        'NAME_GOS.ADR_ID',
        'NAME_GOS.GEO.LAT',
        'NAME_GOS.GEO.LON',
        'NAME_GOS.ACCESS',
    ];

    protected static function processData(array $data, OdDataset $dataset): void
    {
        $rows = $data['RESULT']['ROWS'];

        foreach ($rows as $row) {
            $address = ($row['NAME_GOS']['CITY'] ?? '') . ', ' . ($row['NAME_GOS']['ADR'] ?? '');

            PhonebookRecord::query()
                ->insert([
                    'fio' => $row['FIO'] ?? null,
                    'post' => $row['POSITION'] ?? null,
                    'phone' => $row['PHONE'] ?? null,
                    'city' => $row['NAME_GOS']['CITY'] ?? null,
                    'administration_body_name' => $row['NAME_GOS']['STRUCT_ORG'] ?? null,
                    'management_department' => $row['NAME_GOS']['STRUCT_ORG'] ?? null,
                    'email' => $row['NAME_GOS']['EMAIL'] ?? null,
                    'address' => $address,
                    'od_api_id' => $dataset->id,
                ]);

            self::$rowNumber++;
        }
    }

    protected static function getColsArray(array $data): array
    {
        return $data['RESULT']['ROWS'][0] ?? [];
    }

    protected static function getValidateRules(): array
    {
        $rules = [
            'RESULT' => 'required|array',
            'RESULT.ROWS' => 'required|array',
            'RESULT.ROWS.*.NAME_GOS' => 'required|array',
        ];

        foreach (static::FIELDS as $field) {
            $rules['RESULT.ROWS.*.' . $field] = 'present|nullable';
        }

        return $rules;
    }
}
