<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers\Organisations;

use Modules\SportSectionsWidget\Models\OdDataset;
use Modules\SportSectionsWidget\Models\Organisation;
use Modules\SportSectionsWidget\OpenDataHandlers\OrganisationsSourceHandler;

class NizhnevartovskSourceHandler extends OrganisationsSourceHandler
{

    protected const array FIELDS = [
        'TITLE',
        'CITY',
        'ADDRESS',
        'INN',
        'URL',
        'EMAIL',
        'TEL',

        //Не используемые
        'DESCRIPTION',
        'FIO',
        'LAT',
        'LON',
        'OKPO',
        'OGRN',
        'KPP',
        'ORG',
        'URL_LINK',
        'GID',
    ];

    public static function processData(array $data, OdDataset $dataset): void
    {
        $rows = $data['RESULT']['ROWS'];
        $municipalityId = $dataset->municipality_id;
        Organisation::query()->where('municipality_id', $municipalityId)->delete();

        foreach ($rows as $row) {
            $cityId = self::getCityId($row['CITY'], $municipalityId);

            Organisation::query()->create([
                'name' => $row['TITLE'],
                'city_id' => $cityId,
                'street' => $row['ADDRESS'],
                'house' => null,
                'inn' => $row['INN'],
                'site' => $row['URL'],
                'email' => $row['EMAIL'],
                'phone' => $row['TEL'],
                'municipality_id' => $municipalityId,
            ]);
            self::$rowNumber++;
        }
    }

    /**
     * Получить первый объект из массива объектов в ответе ОД
     * @param $data
     * @return array
     */
    public static function getColsArray($data): array
    {
        return $data['RESULT']['ROWS'][0] ?? [];
    }

    /**
     * Получить правила валидации объектов ответа ОД
     * @return array
     */
    protected static function getValidateRules(): array
    {
        $rules = [
            'RESULT' => 'required|array',
            'RESULT.ROWS' => 'required|array',
            'ROWS.*.cols' => 'required|array',
        ];

        foreach (static::FIELDS as $field) {
            $rules['rows.*.' . $field] = 'present|string|nullable';
        }

        return $rules;
    }
}
