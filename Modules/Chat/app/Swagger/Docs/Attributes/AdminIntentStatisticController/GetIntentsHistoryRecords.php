<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminIntentStatisticController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetIntentsHistoryRecords extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/intents/statistic/get_history',
            operationId: 'getIntentsHistoryRecords',
            summary: 'Получить историю вызовов интентов',
            tags: [
                'AdminIntentStatisticController'
            ],
            parameters: [
                new OA\Parameter(
                    name: 'date_from',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(
                        type: 'string',
                        format: 'date',
                        example: '01.05.2025'
                    ),
                    description: 'Дата начала периода'
                ),
                new OA\Parameter(
                    name: 'date_to',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(
                        type: 'string',
                        format: 'date',
                        example: '31.05.2025'
                    ),
                    description: 'Дата конца периода'
                ),
                new OA\Parameter(
                    name: 'vika_type_id',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(
                        type: 'integer',
                        example: 1
                    ),
                    description: 'ID типа Вики'
                ),
                new OA\Parameter(
                    name: 'chat_id',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(
                        type: 'string',
                        example: '3a945988-ec00-46a2-868b-f078f6ba5353'
                    ),
                    description: 'ID чата'
                ),
                new OA\Parameter(
                    name: 'from_tg',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(
                        type: 'integer',
                        example: 0
                    ),
                    description: 'Источник сообщения (0 - не из Telegram, 1 - из Telegram, null - все)'
                ),
                new OA\Parameter(
                    name: 'from_max',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'integer'),
                    description: 'Источник сообщения (0 - не из Max, 1 - из Max, null - все)',
                    example: 1
                ),
                new OA\Parameter(
                    name: 'per_page',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(
                        type: 'integer',
                        example: 15
                    ),
                    description: 'Количество элементов на странице'
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Успешный ответ',
                    content: new OA\JsonContent(
                        type: "object",
                        allOf: [
                            new OA\Property(
                                ref: '#/components/schemas/LengthAwarePaginator'
                            ),
                            new OA\Schema(
                                properties: [
                                    new OA\Property(
                                        property: 'data',
                                        description: 'Список записей истории',
                                        type: 'array',
                                        items: new OA\Items(
                                            type: 'object',
                                            properties: [
                                                new OA\Property(
                                                    property: 'id',
                                                    type: 'integer',
                                                    description: 'ID записи',
                                                    example: 11
                                                ),
                                                new OA\Property(
                                                    property: 'intent_id',
                                                    type: 'integer',
                                                    description: 'ID интента',
                                                    example: 44
                                                ),
                                                new OA\Property(
                                                    property: 'chat_id',
                                                    type: 'string',
                                                    description: 'ID чата',
                                                    example: '3a945988-ec00-46a2-868b-f078f6ba5353'
                                                ),
                                                new OA\Property(
                                                    property: 'created_at',
                                                    type: 'string',
                                                    description: 'Дата создания',
                                                    example: '2025-05-27T08:35:42.000000Z'
                                                ),
                                                new OA\Property(
                                                    property: 'from_tg',
                                                    type: 'integer',
                                                    description: 'Источник сообщения (0 - не из Telegram, 1 - из Telegram)',
                                                    example: 1
                                                ),
                                                new OA\Property(
                                                    property: 'from_max',
                                                    type: 'integer',
                                                    description: 'Источник сообщения (0 - не из Max, 1 - из Max)',
                                                    example: 1
                                                ),
                                                new OA\Property(
                                                    property: 'vika_type_id',
                                                    type: 'integer',
                                                    description: 'ID типа Вики',
                                                    example: 1
                                                ),
                                                new OA\Property(
                                                    property: 'message',
                                                    type: 'string',
                                                    description: 'Сообщение',
                                                    example: 'телефон прокудина'
                                                ),
                                                new OA\Property(
                                                    property: 'entities',
                                                    type: 'array',
                                                    description: 'Определённые сущности в сообщении',
                                                    items: new OA\Items(
                                                        type: 'object',
                                                        properties: [
                                                            new OA\Property(
                                                                property: 'type',
                                                                type: 'string',
                                                                description: 'Тип сущности',
                                                                example: 'locality'
                                                            ),
                                                            new OA\Property(
                                                                property: 'value',
                                                                type: 'string',
                                                                description: 'Значение сущности',
                                                                example: 'Ханты-Мансийск'
                                                            ),
                                                            new OA\Property(
                                                                property: 'start',
                                                                type: 'integer',
                                                                description: 'Начальная позиция',
                                                                example: 17
                                                            ),
                                                            new OA\Property(
                                                                property: 'end',
                                                                type: 'integer',
                                                                description: 'Конечная позиция',
                                                                example: 22
                                                            ),
                                                        ]
                                                    ),
                                                ),
                                                new OA\Property(
                                                    property: 'chat_intent',
                                                    type: 'object',
                                                    description: 'Информация об интенте',
                                                    properties: [
                                                        new OA\Property(
                                                            property: 'id',
                                                            type: 'integer',
                                                            example: 44
                                                        ),
                                                        new OA\Property(
                                                            property: 'code',
                                                            type: 'string',
                                                            example: 'phonebook'
                                                        ),
                                                        new OA\Property(
                                                            property: 'name',
                                                            type: 'string',
                                                            example: 'Телефонный справочник'
                                                        ),
                                                        new OA\Property(
                                                            property: 'active',
                                                            type: 'boolean',
                                                            example: true
                                                        ),
                                                    ]
                                                ),
                                                new OA\Property(
                                                    property: 'vika_type',
                                                    type: 'object',
                                                    description: 'Информация о типе Вики',
                                                    properties: [
                                                        new OA\Property(
                                                            property: 'id',
                                                            type: 'integer',
                                                            example: 1
                                                        ),
                                                        new OA\Property(
                                                            property: 'name',
                                                            type: 'string',
                                                            example: 'main'
                                                        ),
                                                        new OA\Property(
                                                            property: 'description',
                                                            type: 'string',
                                                            example: 'Основной чат'
                                                        ),
                                                    ]
                                                ),
                                            ],
                                        ),
                                    ),
                                ],
                            ),
                        ],
                    ),
                ),
            ],
        );
    }
}
