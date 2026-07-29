<?php

namespace Modules\PhoneBookWidget\OpenDataHandlers;

use Modules\PhoneBookWidget\Models\OdDataset;
use Modules\PhoneBookWidget\Models\PhonebookRecord;

class KhantyMansiyskAdministrationSourceHandler extends AbstractSourceHandler
{
    protected const array FIELDS = [
        'name',
        'position',
        'phone',
        'city',
        'name_gos',
        'department',
        'email',
        'city',
        'street',
        'house',
    ];

    public static function processData(array $data, OdDataset $dataset): void
    {
        $rows = $data['result']['response'];

        foreach ($rows as $row) {
            $address =
                $row['city'] . ', ' .
                $row['street'] . ', ' .
                $row['house'];

            PhonebookRecord::query()
                ->insert([
                    'fio' => $row['name'] ?? null,
                    'post' => $row['position'] ?? null,
                    'phone' => $row['phone'] ?? null,
                    'city' => $row['city'] ?? null,
                    'administration_body_name' => $row['name_gos'] ?? null,
                    'management_department' => $row['department'] ?? null,
                    'email' => $row['email'] ?? null,
                    'address' => $address,
                    'od_api_id' => $dataset->id
                ]);

            self::$rowNumber++;
        }
    }

    public static function getColsArray(array $data): array
    {
        return $data['result']['response'][0] ?? [];
    }

    protected static function getValidateRules(): array
    {
        $rules = [
            'result' => 'required|array',
            'result.response' => 'required|array|nullable',
        ];

        foreach (static::FIELDS as $field) {
            $rules['result.response.*.' . $field] = 'present|string|nullable';
        }

        return $rules;
    }
}
