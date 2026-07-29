<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers\Trainers;

use Modules\SportSectionsWidget\Models\Schedule;
use Modules\SportSectionsWidget\Models\Section;
use Modules\SportSectionsWidget\Models\Trainer;
use Modules\SportSectionsWidget\OpenDataHandlers\TrainersSourceHandler;

class NyaganSourceHandler extends TrainersSourceHandler
{

    protected const array FIELDS = [
        'IDENTIFIKATOR_SPORTIVNOY_ORGANIZATSII',
        'NAZVANIE_SEKTSII',
        'VOZRASTNYE_OGRANICHENIYA',
        'FIO_TRENERA',
        'NASELENNYY_PUNKT',
        'ULITSA',
        'DOM',
        'PONEDELNIK',
        'VTORNIK',
        'SREDA',
        'CHETVERG',
        'PYATNITSA',
        'SUBBOTA',
        'VOSKRESENE',

        //Не используемые
        '_P_P',
    ];

    #[\Override]
    protected static function handleRowData(array $row, int $municipalityId): void
    {
        $row = $row['cols'];

        $attributes = [
            'name' => $row['FIO_TRENERA'],
            'phone' => null,
            'category' => null,
            'municipality_id' => $municipalityId,
        ];
        $trainer = self::createModelWithTrimAttributes(new Trainer, $attributes);

        $organisationId = self::getOrganisationId($row['IDENTIFIKATOR_SPORTIVNOY_ORGANIZATSII']);
        $sportId = self::getSportId($row['NAZVANIE_SEKTSII']);
        $cityId = self::getCityId($row['NASELENNYY_PUNKT'], $municipalityId);
        [$min, $max] = self::extractAgeRange($row['VOZRASTNYE_OGRANICHENIYA']);

        $section = Section::query()->create([
            'organisation_id' => $organisationId,
            'sport_id' => $sportId,
            'city_id' => $cityId,
            'street' => $row['ULITSA'],
            'house' => $row['DOM'],
            'trainer_id' => $trainer->getKey(),
            'age_min' => $min,
            'age_max' => $max,
            'municipality_id' => $municipalityId,
        ]);

        Schedule::query()->create([
            'section_id' => $section->id,
            'monday' => $row['PONEDELNIK'],
            'tuesday' => $row['VTORNIK'],
            'wednesday' => $row['SREDA'],
            'thursday' => $row['CHETVERG'],
            'friday' => $row['PYATNITSA'],
            'saturday' => $row['SUBBOTA'],
            'sunday' => $row['VOSKRESENE'],
        ]);
    }
}
