<?php

namespace Modules\BusinessSupportWidget\Swagger\Components;

use OpenApi\Attributes as OA;

#[OA\Schema(

    description: 'Жизненная ситуация',
    properties: [
        new OA\Property(
            property: 'id',
            type: 'integer',
            example: 1,
        ),
        new OA\Property(
            property: 'name',
            description: 'Наименование жизненной ситуации',
            type: 'string',
            example: 'Возмещение части затрат на аренду (субаренду) нежилых помещений',
        ),
    ]
)]
class BusinessSupportSituation {}
