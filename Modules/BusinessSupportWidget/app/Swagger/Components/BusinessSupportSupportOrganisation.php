<?php

namespace Modules\BusinessSupportWidget\Swagger\Components;

use OpenApi\Attributes as OA;

#[OA\Schema(

    description: 'Организация, предоставляющая меру поддержки',
    properties: [
        new OA\Property(
            property: 'id',
            type: 'integer',
            example: 1,
        ),
        new OA\Property(
            property: 'name',
            description: 'Название организации, предоставляющей меру поддержки',
            type: 'string',
            example: 'Администрация Березовского района',
        ),
    ]
)]
class BusinessSupportSupportOrganisation {}
