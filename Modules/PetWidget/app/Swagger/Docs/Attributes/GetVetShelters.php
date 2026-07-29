<?php

namespace Modules\PetWidget\Swagger\Docs\Attributes;


use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetVetShelters extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/pet/shelters/list',
            operationId: 'getPetWidgetVetShelters',
            tags: ['PetWidget'],
            summary: 'Получить список населённых пунктов с приютами внутри',
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
                                    property: 'pet_widget_vet_shelters',
                                    type: 'array',
                                    description: 'Список приютов в населённому пункте',
                                    items: new OA\Items(
                                        type: 'object',
                                        properties: [
                                            new OA\Property(
                                                property: 'id',
                                                type: 'integer',
                                                description: 'Уникальный идентификатор приюта',
                                                example: 20,
                                            ),
                                            new OA\Property(
                                                property: 'name',
                                                type: 'string',
                                                description: 'Название приюта',
                                                example: 'Руководитель муниципального приюта для животных Журенко Д.А.',
                                            ),
                                            new OA\Property(
                                                property: 'locality_id',
                                                type: 'integer',
                                                description: 'Уникальный идентификатор населённого пункта',
                                                example: 1,
                                            ),
                                            new OA\Property(
                                                property: 'pet_widget_vet_shelter_addresses',
                                                type: 'array',
                                                description: 'Адреса приюта',
                                                items: new OA\Items(
                                                    type: 'object',
                                                    properties: [
                                                        new OA\Property(
                                                            property: 'id',
                                                            type: 'integer',
                                                            description: 'Уникальный идентификатор адреса',
                                                            example: 1,
                                                        ),
                                                        new OA\Property(
                                                            property: 'address',
                                                            type: 'string',
                                                            description: 'Непосредственно адрес',
                                                            example: 'ул. Кедровая, 50, г. Когалым',
                                                        ),
                                                        new OA\Property(
                                                            property: 'shelter_id',
                                                            type: 'integer',
                                                            description: 'Уникальный идентификатор приюта',
                                                            example: 20,
                                                        ),
                                                    ],
                                                ),
                                            ),
                                            new OA\Property(
                                                property: 'pet_widget_vet_shelter_emails',
                                                type: 'array',
                                                description: 'Адреса электронной почты',
                                                items: new OA\Items(
                                                    type: 'object',
                                                    properties: [
                                                        new OA\Property(
                                                            property: 'id',
                                                            type: 'integer',
                                                            description: 'Уникальный идентификатор почты',
                                                            example: 1,
                                                        ),
                                                        new OA\Property(
                                                            property: 'email',
                                                            type: 'string',
                                                            description: 'Непосредственно почта',
                                                            example: 'dasha1446@mail.ru',
                                                        ),
                                                        new OA\Property(
                                                            property: 'shelter_id',
                                                            type: 'integer',
                                                            description: 'Уникальный идентификатор клиники',
                                                            example: 1,
                                                        ),
                                                    ],
                                                ),
                                            ),
                                            new OA\Property(
                                                property: 'pet_widget_vet_shelter_phones',
                                                type: 'array',
                                                description: 'Телефоны клиники',
                                                items: new OA\Items(
                                                    type: 'object',
                                                    properties: [
                                                        new OA\Property(
                                                            property: 'id',
                                                            type: 'integer',
                                                            description: 'Уникальный идентификатор номера телефона',
                                                            example: 1,
                                                        ),
                                                        new OA\Property(
                                                            property: 'phone',
                                                            type: 'string',
                                                            description: 'Непосредственно телефон',
                                                            example: '89923527050',
                                                        ),
                                                        new OA\Property(
                                                            property: 'shelter_id',
                                                            type: 'integer',
                                                            description: 'Уникальный идентификатор приюта',
                                                            example: 1,
                                                        ),
                                                    ],
                                                ),
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
