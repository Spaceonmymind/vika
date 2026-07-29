<?php

namespace Modules\PetWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetPetLocalities extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/pet/get_localities",
            operationId: "getPetWidgetLocalities",
            tags: ["PetWidget"],
            summary: "Получить список населённых пунктов",
            parameters: [
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Successful operation",
                    content: new OA\JsonContent(
                        type: "object",
                        properties: [
                            new OA\Property(
                                property: "id",
                                type: "integer",
                                description: "Уникальный идентификатор населённого пункта",
                                example: 1
                            ),
                            new OA\Property(
                                property: "name",
                                type: "string",
                                description: "Наименование населённого пункта",
                                example: 'Белоярский'
                            ),
                        ]
                    )
                )
            ]
        );
    }
}
