<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers\Trainers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Modules\SportSectionsWidget\Models\OdDataset;
use Modules\SportSectionsWidget\Models\Organisation;
use Modules\SportSectionsWidget\Models\Section;
use Modules\SportSectionsWidget\Models\Trainer;
use Modules\SportSectionsWidget\OpenDataHandlers\TrainersSourceHandler;

class NizhnevartovskSourceHandler extends TrainersSourceHandler
{

    protected const array FIELDS = [
        'FIO',
        'TEL',
        'CAT',
        'DESCRIPTION',

        //Не используемые
        'GID',
        'ORG',
        'ORG_INN',
    ];

    public static function processData(array $data, OdDataset $dataset): void
    {
        $rows = $data['RESULT']['ROWS'];
        $municipalityId = $dataset->municipality_id;
        Trainer::query()->where('municipality_id', $municipalityId)->delete();

        foreach ($rows as $row) try {
            static::handleRowData($row, $municipalityId);
            self::$rowNumber++;
        } catch (ModelNotFoundException $e) {
            Log::channel(static::DATASET_LOG_CHANEL)->error('processData Error Ошибка при обновлении информации о спортивных секциях',
                [
                    'handler' => static::class,
                    'row' => static::$rowNumber,
                    'dataset_url' => $dataset->url,
                    'error' => $e->getMessage(),
//                    'trace' => $e->getTraceAsString(),
                ]);
//            Log::channel(static::TELEGRAM_LOG_CHANEL)->error($e->getMessage() . ' \n ' . 'URL: ' . $dataset->url);
        }
        if (count(self::$unknownTrainers) > 0) {
            Log::channel(static::TELEGRAM_LOG_CHANEL)->warning("В наборе <a href=\"$dataset->url\">$dataset->description</a> Не найдены тренеры с указанными ФИО:  \n" . implode("\n", self::$unknownTrainers));
            self::$unknownTrainers = [];
        }
        if (count(self::$unknownInns) > 0) {
            Log::channel(static::TELEGRAM_LOG_CHANEL)->warning("В наборе <a href=\"$dataset->url\">$dataset->description</a> Не найдены организации с указанными ИНН:  \n" . implode(", ", self::$unknownInns));
            self::$unknownInns = [];
        }
    }

    #[\Override]
    protected static function handleRowData(array $row, int $municipalityId): void
    {
        $attributes = [
            'name' => $row['FIO'],
            'phone' => $row['TEL'],
            'category' => $row['CAT'],
            'municipality_id' => $municipalityId,
        ];
        $trainer = self::createModelWithTrimAttributes(new Trainer, $attributes);

        $organisationId = self::getOrganisationId($row['ORG_INN']);
        $sportId = self::getSportId($row['DESCRIPTION']);
        $organisation = Organisation::query()->find($organisationId);
        $cityId = $organisation->city_id;
        $street = $organisation->street;

        Section::query()->create([
            'organisation_id' => $organisationId,
            'sport_id' => $sportId,
            'city_id' => $cityId,
            'street' => $street,
            'house' => null,
            'trainer_id' => $trainer->getKey(),
            'age_min' => null,
            'age_max' => null,
            'municipality_id' => $municipalityId,
        ]);
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
