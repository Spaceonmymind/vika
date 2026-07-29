<?php

namespace Modules\BusinessSupportWidget\Swagger\Components;

use OpenApi\Attributes as OA;

#[OA\Schema(

    description: 'Получатель поддержки',
    properties: [
        new OA\Property(
            property: 'id',
            type: 'integer',
            example: 2,
        ),
        new OA\Property(
            property: 'name',
            description: 'Наименование получателя поддержки',
            type: 'string',
            example: 'Субъект малого и среднего предпринимательства',
        ),
    ]
)]
class BusinessSupportSubject {}
