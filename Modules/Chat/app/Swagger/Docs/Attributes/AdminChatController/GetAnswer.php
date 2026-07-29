<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminChatController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetAnswer extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/answers/{answer_id}/get',
            operationId: 'getChatAnswer',
            summary: 'Получить деталку ответа',
            description: 'Возвращает полную информацию об ответе, включая связанные интенты, тексты ответов, кнопки и виджеты.',
            tags: ['AdminChatController'],
            parameters: [
                new OA\Parameter(
                    name: 'answer_id',
                    description: 'ID ответа',
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer'),
                    example: 1
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Successful operation',
                    content: new OA\JsonContent(
                        type: 'object',
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

                            new OA\Property(
                                property: 'chat_answer_texts',
                                type: 'array',
                                description: 'Тексты ответа, при отправке в чат выбирается один случайный ответ',
                                items: new OA\Items(
                                    type: 'object',
                                    properties: [
                                        new OA\Property(
                                            property: 'id',
                                            type: 'integer',
                                            description: 'ID текста ответа',
                                            example: 1
                                        ),
                                        new OA\Property(
                                            property: 'text',
                                            type: 'string',
                                            description: 'HTML-форматированный текст ответа',
                                            example: 'Для того чтобы узнать <b>цены на топливо</b>, вам необходимо открыть виджет, нажав на соответствующую кнопку'
                                        ),
                                        new OA\Property(
                                            property: 'answer_id',
                                            type: 'integer',
                                            description: 'ID связанного ответа',
                                            example: 1
                                        )
                                    ]
                                )
                            ),

                            new OA\Property(
                                property: 'chat_answer_buttons',
                                type: 'array',
                                description: 'Кнопки, связанные с ответом',
                                items: new OA\Items(
                                    type: 'object',
                                    properties: [
                                        new OA\Property(
                                            property: 'id',
                                            type: 'integer',
                                            description: 'ID кнопки',
                                            example: 1
                                        ),
                                        new OA\Property(
                                            property: 'button_type_id',
                                            type: 'integer',
                                            description: 'ID типа кнопки (1 - виджет, 2 - ссылка)',
                                            example: 2
                                        ),
                                        new OA\Property(
                                            property: 'name',
                                            type: 'string',
                                            description: 'Название кнопки (для админки)',
                                            example: 'Кнопка посмотреть цены газпром'
                                        ),
                                        new OA\Property(
                                            property: 'answer_id',
                                            type: 'integer',
                                            description: 'ID связанного ответа',
                                            example: 1
                                        ),
                                        new OA\Property(
                                            property: 'button_message_text',
                                            type: 'string',
                                            description: 'Текст, который будет отображаться на кнопке для пользователя',
                                            example: 'Посмотреть цены на топливо на заправках "Газпром"'
                                        ),
                                        new OA\Property(
                                            property: 'url',
                                            type: 'string',
                                            description: 'URL для кнопок-ссылок',
                                            example: 'https://www.gazprom.ru/',
                                            nullable: true
                                        ),
                                        new OA\Property(
                                            property: 'chat_widget_id',
                                            type: 'integer',
                                            description: 'ID виджета для кнопок-виджетов',
                                            example: null,
                                            nullable: true
                                        ),
                                        new OA\Property(
                                            property: 'created_at',
                                            type: 'string',
                                            format: 'date-time',
                                            description: 'Дата создания кнопки',
                                            example: '2025-03-11T11:56:01.000000Z'
                                        ),
                                        new OA\Property(
                                            property: 'updated_at',
                                            type: 'string',
                                            format: 'date-time',
                                            description: 'Дата последнего обновления кнопки',
                                            example: '2025-03-11T11:56:01.000000Z'
                                        ),

                                        new OA\Property(
                                            property: 'chat_answer_button_type',
                                            type: 'object',
                                            description: 'Тип кнопки',
                                            properties: [
                                                new OA\Property(
                                                    property: 'id',
                                                    type: 'integer',
                                                    description: 'ID типа кнопки',
                                                    example: 2
                                                ),
                                                new OA\Property(
                                                    property: 'code',
                                                    type: 'string',
                                                    description: 'Код типа кнопки',
                                                    example: 'link'
                                                ),
                                                new OA\Property(
                                                    property: 'name',
                                                    type: 'string',
                                                    description: 'Название типа кнопки',
                                                    example: 'Ссылка'
                                                )
                                            ]
                                        ),

                                        new OA\Property(
                                            property: 'chat_answer_button_entities',
                                            type: 'array',
                                            description: 'Сущности, связанные с кнопкой (параметры для виджетов/ссылок)',
                                            items: new OA\Items(
                                                type: 'object',
                                                properties: [
                                                    new OA\Property(
                                                        property: 'id',
                                                        type: 'integer',
                                                        description: 'ID сущности',
                                                        example: 3
                                                    ),
                                                    new OA\Property(
                                                        property: 'button_id',
                                                        type: 'integer',
                                                        description: 'ID связанной кнопки',
                                                        example: 1
                                                    ),
                                                    new OA\Property(
                                                        property: 'code',
                                                        type: 'string',
                                                        description: 'Код сущности, который присылает Толя',
                                                        example: 'fuel_type'
                                                    ),
                                                    new OA\Property(
                                                        property: 'param_name',
                                                        type: 'string',
                                                        description: 'Имя параметра для запроса, который будет подставлен в виджет или ссылку',
                                                        example: 'fuel_type_ids'
                                                    ),
                                                    new OA\Property(
                                                        property: 'multiple',
                                                        type: 'boolean',
                                                        description: 'Множественный ли параметр',
                                                        example: true
                                                    ),
                                                    new OA\Property(
                                                        property: 'table',
                                                        type: 'string',
                                                        nullable: true,
                                                        description: 'Таблица где искать справочное значение сущности (обязательна вместе с search_column и value_column)',
                                                        example: 'fuel_price_widget_fuel_types'
                                                    ),
                                                    new OA\Property(
                                                        property: 'search_column',
                                                        type: 'string',
                                                        nullable: true,
                                                        description: 'Столбец, по которому выполняется поиск (обязательна вместе с table и value_column)',
                                                        example: 'code'
                                                    ),
                                                    new OA\Property(
                                                        property: 'value_column',
                                                        type: 'string',
                                                        nullable: true,
                                                        description: 'Столбец для получения значения, которое будет подставлено в параметр (обязательна вместе с table и search_column)',
                                                        example: 'id'
                                                    ),
                                                    new OA\Property(
                                                        property: 'created_at',
                                                        type: 'string',
                                                        format: 'date-time',
                                                        description: 'Дата создания сущности',
                                                        example: '2025-03-12T06:12:59.000000Z'
                                                    ),
                                                    new OA\Property(
                                                        property: 'updated_at',
                                                        type: 'string',
                                                        format: 'date-time',
                                                        description: 'Дата обновления сущности',
                                                        example: '2025-03-12T06:12:59.000000Z'
                                                    )
                                                ]
                                            )
                                        ),

                                        new OA\Property(
                                            property: 'chat_widget',
                                            type: 'object',
                                            description: 'Связанный чат-виджет (только для кнопок типа "виджет")',
                                            nullable: true,
                                            properties: [
                                                new OA\Property(
                                                    property: 'id',
                                                    type: 'integer',
                                                    description: 'ID виджета',
                                                    example: 1
                                                ),
                                                new OA\Property(
                                                    property: 'name',
                                                    type: 'string',
                                                    description: 'Название виджета',
                                                    example: 'Цены на топливо'
                                                ),
                                                new OA\Property(
                                                    property: 'is_active',
                                                    type: 'boolean',
                                                    description: 'Флаг активности виджета',
                                                    example: true
                                                ),
                                                new OA\Property(
                                                    property: 'description',
                                                    type: 'string',
                                                    description: 'Описание виджета',
                                                    example: 'Цены на топливо'
                                                ),
                                                new OA\Property(
                                                    property: 'code_name',
                                                    type: 'string',
                                                    description: 'Код виджета',
                                                    example: 'vi-gas'
                                                )
                                            ]
                                        )
                                    ]
                                )
                            )
                        ]
                    )
                )
            ]
        );
    }
}
