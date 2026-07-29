<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminChatController;



use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetAnswers extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/answers/list',
            operationId: 'getAnswers',
            summary: 'Получить список ответов',
            tags: ['AdminChatController'],
            parameters: [
                new OA\Parameter(
                    name: 'intent_id',
                    in: 'query',
                    schema: new OA\Schema(type: 'integer'),
                    description: 'Фильтр по интенту',
                    example: 1,
                ),
                new OA\Parameter(
                    name: 'vika_type_id',
                    in: 'query',
                    schema: new OA\Schema(type: 'integer'),
                    description: 'Фильтр по типу Вики',
                    example: 1,
                ),
                new OA\Parameter(
                    name: 'is_active',
                    in: 'query',
                    schema: new OA\Schema(type: 'integer'),
                    description: 'Какие ответы показывать: 1-Активные, 0-Неактивные, null-Все',
                    example: 1,
                ),
                new OA\Parameter(
                    name: 'name',
                    in: 'query',
                    schema: new OA\Schema(type: 'string'),
                    description: 'Фильтр по названию ответа',
                    example: 'Заглушка',
                ),
                new OA\Parameter(
                    name: 'per_page',
                    in: 'query',
                    schema: new OA\Schema(type: 'integer'),
                    description: 'Количество элементов на странице',
                    example: 15,
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Successful operation',
                    content: new OA\JsonContent(
                        type: "object",
                        allOf: [
                            new OA\Property(ref: '#/components/schemas/LengthAwarePaginator'),
                            new OA\Schema(
                                properties: [
                                    new OA\Property(
                                        property: 'data',
                                        description: 'Список ролей',
                                        type: 'array',
                                        items: new OA\Items(
                                            type: 'object',
                                            description: 'Объект описания роли',
                                            title: 'Роль',
                                            properties: [
                                                new OA\Property(
                                                    property: 'id',
                                                    type: 'integer',
                                                    description: 'Уникальный идентификатор ответа',
                                                    example: 1
                                                ),
                                                new OA\Property(
                                                    property: 'name',
                                                    type: 'string',
                                                    description: 'Название ответа',
                                                    example: 'Ответ с кнопкой вызова виджета "топливо"'
                                                ),
                                                new OA\Property(
                                                    property: 'intent_id',
                                                    type: 'integer',
                                                    description: 'ID интента, к которому привязан ответ',
                                                    example: 1
                                                ),
                                                new OA\Property(
                                                    property: 'is_active',
                                                    type: 'boolean',
                                                    description: 'Флаг активности ответа',
                                                    example: true
                                                ),
                                                new OA\Property(
                                                    property: 'created_at',
                                                    type: 'string',
                                                    format: 'date-time',
                                                    description: 'Дата и время создания записи',
                                                    example: '2025-03-11T11:54:18.000000Z'
                                                ),
                                                new OA\Property(
                                                    property: 'updated_at',
                                                    type: 'string',
                                                    format: 'date-time',
                                                    description: 'Дата и время последнего обновления записи',
                                                    example: '2025-03-11T11:54:18.000000Z'
                                                ),
                                                new OA\Property(
                                                    property: 'vika_type_id',
                                                    type: 'integer',
                                                    description: 'ID типа вики, к которому привязан ответ',
                                                    example: 1
                                                ),

                                                new OA\Property(
                                                    property: 'chat_intent',
                                                    type: 'object',
                                                    description: 'Информация об интенте',
                                                    properties: [
                                                        new OA\Property(
                                                            property: 'id',
                                                            type: 'integer',
                                                            description: 'ID интента',
                                                            example: 1
                                                        ),
                                                        new OA\Property(
                                                            property: 'name',
                                                            type: 'string',
                                                            description: 'Название интента',
                                                            example: 'Цены на топливо'
                                                        ),
                                                        new OA\Property(
                                                            property: 'code',
                                                            type: 'string',
                                                            description: 'Код интента',
                                                            example: 'benz'
                                                        )
                                                    ]
                                                ),

                                                new OA\Property(
                                                    property: 'vika_type',
                                                    type: 'object',
                                                    description: 'Тип вики',
                                                    properties: [
                                                        new OA\Property(
                                                            property: 'id',
                                                            type: 'integer',
                                                            description: 'ID типа вики',
                                                            example: 1
                                                        ),
                                                        new OA\Property(
                                                            property: 'name',
                                                            type: 'string',
                                                            description: 'Код типа вики',
                                                            example: 'main'
                                                        ),
                                                        new OA\Property(
                                                            property: 'description',
                                                            type: 'string',
                                                            description: 'Название типа вики',
                                                            example: 'Основной чат'
                                                        )
                                                    ]
                                                ),
                                            ]
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
