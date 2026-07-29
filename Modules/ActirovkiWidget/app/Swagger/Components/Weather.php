<?php

namespace Modules\ActirovkiWidget\Swagger\Components;

use OpenApi\Attributes as OA;

#[OA\Schema(
    description: 'Данные погоды',
    properties: [
        new OA\Property(
            property: 'id',
            description: 'ID данных погоды',
            type: 'integer',
            example: 1,
        ),
        new OA\Property(
            property: 'city_id',
            description: 'ID населенного пункта',
            type: 'integer',
            format: 'int64',
            example: 10
        ),
        new OA\Property(
            property: 'temperature',
            description: 'Температура',
            type: 'decimal',
            example: -27.15,
        ),
        new OA\Property(
            property: 'wind',
            description: 'Скорость ветра',
            type: 'decimal',
            example: 5.1,
        ),
        new OA\Property(
            property: 'created_at',
            description: 'Время создания',
            type: 'datetime',
            example: '2025-04-03T05:42:59.000000Z'
        ),
        new OA\Property(
            property: 'received_at',
            description: 'Время получения данных от метеостанции',
            type: 'datetime',
            example: '2025-04-03T05:42:59.000000Z'
        ),
    ]
)]
class Weather
{
}
