<?php

namespace Modules\BusinessSupportWidget\Swagger\Components;

use OpenApi\Attributes as OA;

#[OA\Schema(

    description: 'Тип поддержки',
    properties: [
        new OA\Property(
            property: 'id',
            type: 'integer',
            example: 1,
        ),
        new OA\Property(
            property: 'name',
            description: 'Наименование типа поддержки',
            type: 'string',
            example: 'Финансовая',
        ),
    ]
)]
class BusinessSupportSupportType {}
