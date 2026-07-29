<?php

namespace Modules\ActirovkiWidget\Swagger\Components;

use OpenApi\Attributes as OA;

#[OA\Schema(
    description: 'Погодные диапазоны',
    properties: [
        new OA\Property(
            property: 'id',
            description: 'ID погодного диапазона',
            type: 'integer',
            example: 1,
        ),
        new OA\Property(
            property: 'city_id',
            description: 'ID населенного пункта',
            type: 'integer',
            format: 'int64',
            example: 28
        ),
        new OA\Property(
            property: 'temperature',
            description: 'Температура',
            type: 'decimal',
            example: -31,
        ),
        new OA\Property(
            property: 'wind',
            description: 'Скорость ветра',
            type: 'decimal',
            example: 10,
        ),
        new OA\Property(
            property: 'school_class',
            description: 'Верхняя граница диапазона классов',
            type: 'integer',
            example: 11
        ),
    ]
)]
class WeatherRange
{
}
