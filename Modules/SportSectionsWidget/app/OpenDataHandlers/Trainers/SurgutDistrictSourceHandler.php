<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers\Trainers;

use Modules\SportSectionsWidget\Models\Schedule;
use Modules\SportSectionsWidget\Models\Section;
use Modules\SportSectionsWidget\Models\Trainer;
use Modules\SportSectionsWidget\OpenDataHandlers\TrainersSourceHandler;

class SurgutDistrictSourceHandler extends TrainersSourceHandler
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

    #[\Override]
    protected static function handleRowData(array $row, int $municipalityId): void
    {
        $row = $row['cols'];

        $attributes = [
            'name' => $row['COACH_NAME'],
            'phone' => null,
            'category' => null,
            'municipality_id' => $municipalityId,
        ];
        $trainer = self::createModelWithTrimAttributes(new Trainer, $attributes);

        $organisationId = self::getOrganisationId($row['ID']);
        $sportId = self::getSportId($row['SECTION_NAME']);
        $cityId = self::getCityId($row['CITY'], $municipalityId);
        [$min, $max] = self::extractAgeRange($row['AGE_LIMIT']);

        $section = Section::query()->create([
            'organisation_id' => $organisationId,
            'sport_id' => $sportId,
            'city_id' => $cityId,
            'street' => $row['STREET'],
            'house' => $row['HOUSE'],
            'trainer_id' => $trainer->getKey(),
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
}
