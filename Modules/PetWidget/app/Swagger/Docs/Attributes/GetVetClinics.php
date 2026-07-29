<?php

namespace Modules\PetWidget\Swagger\Docs\Attributes;


use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetVetClinics extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/pet/clinics/list',
            operationId: 'getPetWidgetVetClinics',
            tags: ['PetWidget'],
            summary: 'Получить список населённых пунктов с клиниками внутри',
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
                                    property: 'pet_widget_vet_clinics',
                                    type: 'array',
                                    description: 'Список клиник в населённому пункте',
                                    items: new OA\Items(
                                        type: 'object',
                                        properties: [
                                            new OA\Property(
                                                property: 'id',
                                                type: 'integer',
                                                description: 'Уникальный идентификатор клиники',
                                                example: 20,
                                            ),
                                            new OA\Property(
                                                property: 'name',
                                                type: 'string',
                                                description: 'Название клиники',
                                                example: 'ветеринарный кабинет',
                                            ),
                                            new OA\Property(
                                                property: 'locality_id',
                                                type: 'integer',
                                                description: 'Уникальный идентификатор населённого пункта',
                                                example: 1,
                                            ),
                                            new OA\Property(
                                                property: 'pet_widget_vet_clinic_addresses',
                                                type: 'array',
                                                description: 'Адреса клиники',
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
                                                            property: 'clinic_id',
                                                            type: 'integer',
                                                            description: 'Уникальный идентификатор клиники',
                                                            example: 20,
                                                        ),
                                                    ],
                                                ),
                                            ),new OA\Property(
                                                property: 'pet_widget_vet_clinic_emails',
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
                                                            example: 'arkanova69@gmail.com',
                                                        ),
                                                        new OA\Property(
                                                            property: 'clinic_id',
                                                            type: 'integer',
                                                            description: 'Уникальный идентификатор клиники',
                                                            example: 20,
                                                        ),
                                                    ],
                                                ),
                                            ),
                                            new OA\Property(
                                                property: 'pet_widget_vet_clinic_phones',
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
                                                            example: '+79044775960',
                                                        ),
                                                        new OA\Property(
                                                            property: 'clinic_id',
                                                            type: 'integer',
                                                            description: 'Уникальный идентификатор клиники',
                                                            example: 20,
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
