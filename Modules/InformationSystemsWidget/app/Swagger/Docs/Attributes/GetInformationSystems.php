<?php

namespace Modules\InformationSystemsWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetInformationSystems extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/information_systems/get_systems_list",
            operationId: "getListOfInformationSystems",
            summary: 'Возвращает список Информационных Систем',
            tags: ['InformationSystemsWidget'],
            parameters: [
                new OA\Parameter(
                    name: 'owner_id',
                    in: 'query',
                    required: false,
                    description: 'Идентификатор владельца',
                    schema: new OA\Schema(
                        type: 'integer'
                    )
                ),
                new OA\Parameter(
                    name: 'operator_id',
                    in: 'query',
                    required: false,
                    description: 'Идентификатор оператора',
                    schema: new OA\Schema(
                        type: 'integer'
                    )
                ),
                new OA\Parameter(
                    name: 'purpose_id',
                    in: 'query',
                    required: false,
                    description: 'Purpose ID',
                    schema: new OA\Schema(
                        type: 'integer'
                    )
                ),
                new OA\Parameter(
                    name: 'name',
                    in: 'query',
                    required: false,
                    description: 'Название ИС',
                    schema: new OA\Schema(
                        type: 'string'
                    )
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Successful operation',
                    content: new OA\JsonContent(
                        type: "object",
                        allOf: [
                            new OA\Property(ref: '#/components/schemas/CursorPaginator'),
                            new OA\Schema(
                                properties: [

                                    new OA\Property(
                                        property: 'data',
                                        description: 'Список ИС',
                                        type: 'array',
                                        items: new OA\Items(
                                            type: 'object',
                                            properties: [
                                                new OA\Property(
                                                    property: 'id',
                                                    type: 'integer',
                                                    example: 551,
                                                ),
                                                new OA\Property(
                                                    property: 'unique_number',
                                                    type: 'string',
                                                    example: '10.0000092',
                                                ),
                                                new OA\Property(
                                                    property: 'full_name',
                                                    type: 'string',
                                                    description: 'Полное название ИС',
                                                    example: 'Информационная система "Мигрант"',
                                                ),
                                                new OA\Property(
                                                    property: 'short_name',
                                                    type: 'string',
                                                    description: 'Короткое название ИС',
                                                    example: 'ИС "Мигрант"',
                                                ),
                                                new OA\Property(
                                                    property: 'targets',
                                                    type: 'string',
                                                    description: 'Описание назначения ИС',
                                                    example: 'Система является цифровым информационным ресурсом, который помогает иностранным гражданам лучше адаптироваться в социальной и культурной среде Ханты-Мансийского автономного округа - Югры.',
                                                ),
                                                new OA\Property(
                                                    property: 'state_info_sys',
                                                    type: 'string',
                                                    example: 'Опытная эксплуатация',
                                                ),
                                                new OA\Property(
                                                    property: 'operator',
                                                    type: 'string',
                                                    example: 'Дептруда и занятости Югры',
                                                ),
                                                new OA\Property(
                                                    property: 'url',
                                                    type: 'string',
                                                    example: 'https://tisugra.admhmao.ru/migrant/',
                                                ),
                                                new OA\Property(
                                                    property: 'owner_id',
                                                    type: 'integer',
                                                    example: 24,
                                                ),
                                                new OA\Property(
                                                    property: 'purposes',
                                                    type: 'array',
                                                    items: new OA\Items(
                                                        type: 'object',
                                                        properties: [
                                                            new OA\Property(
                                                                property: 'id',
                                                                type: 'integer',
                                                                example: 4,
                                                            ),
                                                            new OA\Property(
                                                                property: 'name',
                                                                type: 'string',
                                                                example: 'Государственные и муниципальные услуги',
                                                            ),
                                                        ]
                                                    )
                                                ),
                                                new OA\Property(
                                                    property: 'subsystems',
                                                    description: 'Подсистемы ИС',
                                                    type: 'array',
                                                    items: new OA\Items(
                                                        type: 'object',
                                                        properties: [
                                                            new OA\Property(
                                                                property: 'id',
                                                                type: 'integer',
                                                                example: 4,
                                                            ),
                                                            new OA\Property(
                                                                property: 'name',
                                                                type: 'string',
                                                                example: 'Веб-интерфейс',
                                                            ),
                                                            new OA\Property(
                                                                property: 'site',
                                                                type: 'string',
                                                                example: 'https://tisugra.admhmao.ru/migrant/',
                                                            ),
                                                            new OA\Property(
                                                                property: 'helpdesk',
                                                                type: 'string',
                                                                description: 'Адрес обращения в поддержку',
                                                                example: 'helptis@admhmao.ru',
                                                            ),
                                                        ]
                                                    )
                                                ),
                                                new OA\Property(
                                                    property: 'owner',
                                                    type: 'object',
                                                    description: 'Информация о владельце',
                                                    properties: [
                                                        new OA\Property(
                                                            property: 'id',
                                                            type: 'integer',
                                                            example: 4,
                                                        ),
                                                        new OA\Property(
                                                            property: 'name',
                                                            type: 'string',
                                                            example: 'ДЕПИНФОРМТЕХНОЛОГИЙ ЮГРЫ',
                                                        ),
                                                    ],
                                                ),
                                            ],
                                        )
                                    )
                                ]
                            ),
                        ],
                    ),
                ),
            ],
        );
    }
}
