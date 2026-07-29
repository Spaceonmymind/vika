<?php

namespace Modules\ActirovkiWidget\Swagger\Components;

use OpenApi\Attributes as OA;

#[OA\Schema(
    description: 'Информация об актировке',
    properties: [
        new OA\Property(
            property: 'id',
            description: 'Уникальный идентификатор',
            type: 'integer',
            format: 'int64',
            example: 1
        ),
        new OA\Property(
            property: 'city_id',
            description: 'ID населенного пункта',
            type: 'integer',
            format: 'int64',
            example: 10
        ),
        new OA\Property(
            property: 'weather_id',
            description: 'ID погодных данных',
            type: 'integer',
            format: 'int64',
            example: 5
        ),
        new OA\Property(
            property: 'weather_range_id',
            description: 'ID диапазона погоды',
            type: 'integer',
            format: 'int64',
            example: 2
        ),
        new OA\Property(
            property: 'cancel_user_id',
            description: 'ID пользователя, отменившего запись',
            type: 'integer',
            format: 'int64',
            example: 3
        ),
        new OA\Property(
            property: 'school_shift',
            description: 'Номер школьной смены',
            type: 'integer',
            example: 1
        ),
        new OA\Property(
            property: 'created_at',
            description: 'Временная метка создания',
            type: 'string',
            format: 'date-time',
            example: '2025-05-12T08:00:00Z'
        ),
        new OA\Property(
            property: 'cancel_at',
            description: 'Временная метка отмены',
            type: 'string',
            format: 'date-time',
            example: '2025-05-12T12:00:00Z',
            nullable: true
        ),
        new OA\Property(
            property: 'send_at',
            description: 'Временная метка отправки',
            type: 'string',
            format: 'date-time',
            example: '2025-05-12T15:00:00Z',
            nullable: true
        ),
        /*new OA\Property(
            property: 'user',
            ref: '#/components/schemas/User'
        ),*/
        new OA\Property(
            property: 'weather',
            ref: '#/components/schemas/Weather'
        ),
        new OA\Property(
            property: 'weatherRange',
            ref: '#/components/schemas/WeatherRange'
        ),
    ]
)]
class Row
{
}
