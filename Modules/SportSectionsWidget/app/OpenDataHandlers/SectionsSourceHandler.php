<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Modules\SportSectionsWidget\Models\OdDataset;
use Modules\SportSectionsWidget\Models\Schedule;
use Modules\SportSectionsWidget\Models\Section;

class SectionsSourceHandler extends AbstractSourceHandler
{

    protected const array FIELDS = [
        'ID',
        'SECTION_NAME',
        'AGE_LIMIT',
        'COACH_NAME',
        'CITY',
        'STREET',
        'HOUSE',
        'WORK_TIME_MON',
        'WORK_TIME_TUE',
        'WORK_TIME_WED',
        'WORK_TIME_THU',
        'WORK_TIME_FRI',
        'WORK_TIME_SAT',
        'WORK_TIME_SUN',

        //Не используемые
        'P_P',
    ];

    public static function processData(array $data, OdDataset $dataset): void
    {
        $rows = $data['rows'];
        $municipalityId = $dataset->municipality_id;
        Section::query()->where('municipality_id', $municipalityId)->delete();

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
        if (count(static::$unknownTrainers) > 0) {
            Log::channel(static::TELEGRAM_LOG_CHANEL)->warning("В наборе <a href=\"$dataset->url\">$dataset->description</a> Не найдены тренеры с указанными ФИО:  \n" . implode("\n", self::$unknownTrainers));
            self::$unknownTrainers = [];
        }
        if (count(static::$unknownInns) > 0) {
            Log::channel(static::TELEGRAM_LOG_CHANEL)->warning("В наборе <a href=\"$dataset->url\">$dataset->description</a> Не найдены организации с указанными ИНН:  \n" . implode(", ", self::$unknownInns));
            self::$unknownInns = [];
        }
    }

    protected static function handleRowData(array $row, int $municipalityId): void
    {
        $row = self::transformKeysAccordingToMappings($row['cols']);
        $cityId = parent::getCityId($row['CITY'], $municipalityId);
        $organisationId = parent::getOrganisationId($row['ID']);
        $sportId = parent::getSportId($row['SECTION_NAME']);
        $trainerId = parent::getTrainerId($row['COACH_NAME']);
        [$min, $max] = self::extractAgeRange($row['AGE_LIMIT']);

        $section = Section::query()->create([
            'organisation_id' => $organisationId,
            'sport_id' => $sportId,
            'city_id' => $cityId,
            'street' => $row['STREET'],
            'house' => $row['HOUSE'],
            'trainer_id' => $trainerId,
            'age_min' => $min,
            'age_max' => $max,
            'municipality_id' => $municipalityId,
        ]);

        Schedule::query()->create([
            'section_id' => $section->id,
            'monday' => $row['WORK_TIME_MON'],
            'tuesday' => $row['WORK_TIME_TUE'],
            'wednesday' => $row['WORK_TIME_WED'],
            'thursday' => $row['WORK_TIME_THU'],
            'friday' => $row['WORK_TIME_FRI'],
            'saturday' => $row['WORK_TIME_SAT'],
            'sunday' => $row['WORK_TIME_SUN'],
        ]);
    }

    protected static function transformKeysAccordingToMappings(array $row): array
    {
        $keyMappings = static::getKeyMappings();
        $transformedRow = [];

        foreach ($row as $key => $value) {
            if (array_key_exists($key, $keyMappings)) {
                $transformedRow[$keyMappings[$key]] = $value;
            } else {
                $transformedRow[$key] = $value;
            }
        }

        return $transformedRow;
    }

    protected static function getKeyMappings(): array
    {
        return [];
    }
}
