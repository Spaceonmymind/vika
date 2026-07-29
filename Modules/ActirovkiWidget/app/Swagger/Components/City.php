<?php

namespace Modules\ActirovkiWidget\Swagger\Components;

use OpenApi\Attributes as OA;

#[OA\Schema(
    description: 'Населенный пункт',
    properties: [
        new OA\Property(
            property: 'id',
            description: 'ID населенного пункта',
            type: 'integer',
            example: 1,
        ),
        new OA\Property(
            property: 'name',
            description: 'Название населенного пункта',
            type: 'string',
            example: 'г. Омск',
        ),
        new OA\Property(
            property: 'fias_id',
            description: 'ФИАС ID',
            type: 'string',
            example: '140e31da-27bf-4519-9ea0-6185d681d44e',
        ),
    ]
)]
class City
{
}
