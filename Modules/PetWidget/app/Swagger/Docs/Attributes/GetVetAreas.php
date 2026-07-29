<?php

namespace Modules\PetWidget\Swagger\Docs\Attributes;


use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetVetAreas extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/pet/areas/list',
            operationId: 'getPetWidgetVetAreas',
            tags: ['PetWidget'],
            summary: 'Получить список населённых пунктов с местами выгула внутри',
            parameters: [
                new OA\Parameter(
                    name: 'locality_id',
                    in: 'query',
                    required: false,
                    description: 'Идентификатор населённого пункта',
                    schema: new OA\Schema(
                        type: 'integer',
                    ),
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Successful operation',
                    content: new OA\JsonContent(
                        type: 'array',
                        items: new OA\Items(
                            type: 'object',
                            properties: [
                                new OA\Property(
                                    property: 'id',
                                    type: 'integer',
                                    description: 'Уникальный идентификатор населённого пункта',
                                    example: 3,
                                ),
                                new OA\Property(
                                    property: 'name',
                                    type: 'string',
                                    description: 'Наименование населённого пункта',
                                    example: 'Когалым',
                                ),
                                new OA\Property(
                                    property: 'pet_widget_vet_areas',
                                    type: 'array',
                                    description: 'Список адресов мест выгула животных',
                                    items: new OA\Items(
                                        type: 'object',
                                        properties: [
                                            new OA\Property(
                                                property: 'id',
                                                type: 'integer',
                                                description: 'Уникальный идентификатор места выгула',
                                                example: 1,
                                            ),
                                            new OA\Property(
                                                property: 'address',
                                                type: 'string',
                                                description: 'Адрес места выгула',
                                                example: 'Белоярский р-н, 5 микрорайон г.Белоярский, муниципальная',
                                            ),
                                            new OA\Property(
                                                property: 'locality_id',
                                                type: 'integer',
                                                description: 'Уникальный идентификатор населённого пункта',
                                                example: 1,
                                            ),

                                        ],
                                    ),
                                ),

                            ],
                        ),
                    ),
                ),
            ],
        );
    }
}
