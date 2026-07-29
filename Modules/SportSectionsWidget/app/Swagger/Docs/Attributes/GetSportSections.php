<?php

namespace Modules\SportSectionsWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetSportSections extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/sport_sections/get_sections",
            operationId: "getSportSections",
            summary: 'Возвращает список секций определенного вида спорта в населённом пункте с информацией о тренере и расписанием.',
            tags: ['SportSectionsWidget'],
            parameters: [
                new OA\Parameter(
                    name: 'city_id',
                    in: 'query',
                    required: false,
                    description: 'Идентификатор населённого пункта',
                    schema: new OA\Schema(
                        type: 'integer'
                    )
                ),
                new OA\Parameter(
                    name: 'sport_id',
                    in: 'query',
                    required: false,
                    description: 'Идентификатор вида спорта',
                    schema: new OA\Schema(
                        type: 'integer'
                    )
                ),
                new OA\Parameter(
                    name: 'age',
                    in: 'query',
                    required: false,
                    description: 'Возраст',
                    schema: new OA\Schema(
                        type: 'integer'
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
                                        description: 'Список секций',
                                        type: 'array',
                                        items: new OA\Items(
                                            type: 'object',
                                            properties: [
                                                new OA\Property(
                                                    property: 'id',
                                                    type: 'integer',
                                                    description: 'Уникальный идентификатор секции',
                                                    example: 17,
                                                ),
                                                new OA\Property(
                                                    property: 'organisation_id',
                                                    type: 'integer',
                                                    description: 'Уникальный идентификатор организации',
                                                    example: '1',
                                                ),
                                                new OA\Property(
                                                    property: 'sport_id',
                                                    type: 'integer',
                                                    description: 'Уникальный идентификатор вида спорта',
                                                    example: '4',
                                                ),
                                                new OA\Property(
                                                    property: 'street',
                                                    type: 'string',
                                                    description: 'Наименование улицы',
                                                    example: 'Почтовая',
                                                ),
                                                new OA\Property(
                                                    property: 'house',
                                                    type: 'string',
                                                    description: 'Номер дома',
                                                    example: '47А'
                                                ),
                                                new OA\Property(
                                                    property: 'trainer_id',
                                                    type: 'integer',
                                                    description: 'Уникальный идентификатор тренера',
                                                    example: 30,
                                                ),
                                                new OA\Property(
                                                    property: 'age_min',
                                                    type: 'integer',
                                                    description: 'Минимальная граница уровня возраста',
                                                    example: 6,
                                                ),
                                                new OA\Property(
                                                    property: 'age_max',
                                                    type: 'integer',
                                                    description: 'Максимальная граница уровня возраста',
                                                    example: 18,
                                                ),
                                                new OA\Property(
                                                    property: 'municipality_id',
                                                    type: 'integer',
                                                    description: 'Уникальный идентификатор муниципалитета',
                                                    example: 2,
                                                ),
                                                new OA\Property(
                                                    property: 'sport',
                                                    type: 'object',
                                                    description: 'Информация о виде спорта',
                                                    properties: [
                                                        new OA\Property(
                                                            property: 'id',
                                                            type: 'integer',
                                                            description: 'Уникальный идентификатор вида спорта',
                                                            example: 4,
                                                        ),
                                                        new OA\Property(
                                                            property: 'name',
                                                            type: 'string',
                                                            description: 'Наименование вида спорта',
                                                            example: 'Волейбол',
                                                        ),
                                                    ],
                                                ),
                                                new OA\Property(
                                                    property: 'trainer',
                                                    type: 'object',
                                                    description: 'Информация о тренере',
                                                    properties: [
                                                        new OA\Property(
                                                            property: 'id',
                                                            type: 'integer',
                                                            description: 'Уникальный идентификатор тренера',
                                                            example: 4,
                                                        ),
                                                        new OA\Property(
                                                            property: 'name',
                                                            type: 'string',
                                                            description: 'ФИО тренера',
                                                            example: 'Бугаева Екатерина Ивановна',
                                                        ),
                                                        new OA\Property(
                                                            property: 'phone',
                                                            type: 'string',
                                                            description: 'Телефон тренера',
                                                            example: '+7-3467-73-57-06',
                                                        ),
                                                        new OA\Property(
                                                            property: 'category',
                                                            type: 'string',
                                                            description: 'Спортивный разряд тренера',
                                                            example: 'нет',
                                                        ),
                                                        new OA\Property(
                                                            property: 'municipality_id',
                                                            type: 'integer',
                                                            description: 'Уникальный идентификатор муниципалитета',
                                                            example: 2,
                                                        ),
                                                    ],
                                                ),
                                                new OA\Property(
                                                    property: 'city',
                                                    type: 'object',
                                                    description: 'Информация о городе',
                                                    properties: [
                                                        new OA\Property(
                                                            property: 'id',
                                                            description: 'Идентификатор города',
                                                            type: 'integer',
                                                            example: 4,
                                                        ),
                                                        new OA\Property(
                                                            property: 'name',
                                                            description: 'Название города',
                                                            type: 'string',
                                                            example: 'г.Нефтеюганск',
                                                        ),
                                                    ],
                                                ),
                                                new OA\Property(
                                                    property: 'schedule',
                                                    type: 'object',
                                                    description: 'Расписание секции',
                                                    properties: [
                                                        new OA\Property(
                                                            property: 'id',
                                                            type: 'integer',
                                                            example: 17,
                                                        ),
                                                        new OA\Property(
                                                            property: 'section_id',
                                                            description: 'Идентификатор секции',
                                                            type: 'integer',
                                                            example: 17,
                                                        ),
                                                        new OA\Property(
                                                            property: 'monday',
                                                            type: 'string',
                                                            example: "14:30-16:30    16:30-18:30",
                                                        ),
                                                        new OA\Property(
                                                            property: 'tuesday',
                                                            type: 'string',
                                                            example: "14:30-16:30    16:30-18:30",
                                                        ),
                                                        new OA\Property(
                                                            property: 'wednesday',
                                                            type: 'string',
                                                            example: "14:30-16:30    16:30-18:30",
                                                        ),
                                                        new OA\Property(
                                                            property: 'thursday',
                                                            type: 'string',
                                                            example: "14:30-16:30    16:30-18:30",
                                                        ),
                                                        new OA\Property(
                                                            property: 'friday',
                                                            type: 'string',
                                                            example: "14:30-16:30    16:30-18:30",
                                                        ),
                                                        new OA\Property(
                                                            property: 'saturday',
                                                            type: 'string',
                                                            example: "14:30-16:30    16:30-18:30",
                                                        ),
                                                        new OA\Property(
                                                            property: 'sunday',
                                                            type: 'string',
                                                            example: "выходной",
                                                        ),
                                                    ],
                                                ),
                                                new OA\Property(
                                                    property: 'organisation',
                                                    type: 'array',
                                                    description: 'Информация об организации',
                                                    items: new OA\Items(
                                                        type: 'object',
                                                        properties: [
                                                            new OA\Property(
                                                                property: 'id',
                                                                type: 'string',
                                                                example: 1,
                                                            ),
                                                            new OA\Property(
                                                                property: 'name',
                                                                type: 'string',
                                                                example: 'Муниципальное бюджетное учреждение дополнительного образования Районная спортивная школа имени И.В Пахтышева'
                                                            ),
                                                            new OA\Property(
                                                                property: 'city_id',
                                                                type: 'integer',
                                                                example: 1,
                                                            ),
                                                            new OA\Property(
                                                                property: 'street',
                                                                type: 'string',
                                                                description: 'Наименование улицы',
                                                                example: 'Почтовая',
                                                            ),
                                                            new OA\Property(
                                                                property: 'house',
                                                                type: 'string',
                                                                description: 'Номер дома',
                                                                example: '47А'
                                                            ),
                                                            new OA\Property(
                                                                property: 'inn',
                                                                type: 'string',
                                                                description: 'ИНН',
                                                                example: '8616006999'
                                                            ),
                                                            new OA\Property(
                                                                property: 'site',
                                                                type: 'string',
                                                                description: 'Сайт',
                                                                example: 'http://86rdyush.edusite.ru/'
                                                            ),
                                                            new OA\Property(
                                                                property: 'phone',
                                                                type: 'string',
                                                                example: '+7-3467-73-57-04'
                                                            ),
                                                            new OA\Property(
                                                                property: 'municipality_id',
                                                                type: 'integer',
                                                                example: 1
                                                            ),
                                                            new OA\Property(
                                                                property: 'city',
                                                                type: 'object',
                                                                description: 'Информация о городе',
                                                                properties: [
                                                                    new OA\Property(
                                                                        property: 'id',
                                                                        description: 'Идентификатор города',
                                                                        type: 'integer',
                                                                        example: 4,
                                                                    ),
                                                                    new OA\Property(
                                                                        property: 'name',
                                                                        description: 'Название города',
                                                                        type: 'string',
                                                                        example: 'г.Нефтеюганск',
                                                                    ),
                                                                ]
                                                            ),
                                                            new OA\Property(
                                                                property: 'municipality',
                                                                type: 'object',
                                                                description: 'Информация о муниципалитете',
                                                                properties: [
                                                                    new OA\Property(
                                                                        property: 'id',
                                                                        type: 'integer',
                                                                        example: 1,
                                                                    ),
                                                                    new OA\Property(
                                                                        property: 'name',
                                                                        type: 'string',
                                                                        example: 'Кондинский район',
                                                                    ),
                                                                ]
                                                            ),
                                                        ],
                                                    ),
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
