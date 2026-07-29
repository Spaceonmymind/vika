<?php

namespace Modules\ActirovkiWidget\Swagger\Components;

use OpenApi\Attributes as OA;

#[OA\Schema(
    description: 'Статус актировки',
    properties: [
        new OA\Property(
            property: 'school_shift',
            description: 'Школьная смена (1 или 2)',
            type: 'integer',
            example: 1,
        ),
        new OA\Property(
            property: 'status',
            description: 'Статус актировки: [pending, announced, not_announced]',
            type: 'string',
            enum: ['pending', 'announced', 'not_announced'],
            example: 'announced',
        ),
        new OA\Property(
            property: 'message',
            description: 'Сообщение',
            type: 'string',
            example: '15.05.2025 занятия 1-й смены с 1 по 4 класс отменяются.',
        ),
        new OA\Property(
            property: 'row',
            ref: '#/components/schemas/Row'
        ),
    ]
)]
class Actirovki
{
}
