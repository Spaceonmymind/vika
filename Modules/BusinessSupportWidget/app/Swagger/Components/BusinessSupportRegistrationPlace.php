<?php

namespace Modules\BusinessSupportWidget\Swagger\Components;

use OpenApi\Attributes as OA;

#[OA\Schema(

    description: 'Места регистрации',
    properties: [
        new OA\Property(
            property: 'id',
            type: 'integer',
            example: 1,
        ),
        new OA\Property(
            property: 'name',
            description: 'Значение места регистрации',
            type: 'string',
            example: 'Состоящий на налоговом учете и осуществляющий свою деятельность на территории Березовского района',
        ),
    ]
)]
class BusinessSupportRegistrationPlace {}
