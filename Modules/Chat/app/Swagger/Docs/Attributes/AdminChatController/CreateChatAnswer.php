<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminChatController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class CreateChatAnswer extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/answers/create',
            operationId: 'createChatAnswer',
            summary: 'Создать новый ответ на интент и привязывает его к типу Вики в определялке интентов',
            tags: ['AdminChatController'],
            requestBody: new OA\RequestBody(
                required: true,
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        required: ['intent_id', 'vika_type_id', 'name', 'chat_answer_texts'],
                        properties: [
                            new OA\Property(
                                property: 'intent_id',
                                type: 'integer',
                                description: 'ID интента',
                                example: 1
                            ),
                            new OA\Property(
                                property: 'vika_type_id',
                                type: 'integer',
                                description: 'ID типа Вики',
                                example: 2
                            ),
                            new OA\Property(
                                property: 'name',
                                type: 'string',
                                description: 'Название ответа',
                                example: 'Ответ на интент "Цены на топливо"'
                            ),
                            new OA\Property(
                                property: 'chat_answer_texts',
                                type: 'array',
                                description: 'Тексты ответов',
                                items: new OA\Items(
                                    type: 'string',
                                    format: 'html',
                                    example: '<b>aaa</b>'
                                )
                            ),
                            new OA\Property(
                                property: 'chat_answer_buttons',
                                type: 'array',
                                description: 'Кнопки ответа',
                                items: new OA\Items(
                                    type: 'object',
                                    required: ['button_type_id', 'name', 'button_message_text','chat_answer_button_entities'],
                                    properties: [
                                        new OA\Property(
                                            property: 'button_type_id',
                                            type: 'integer',
                                            description: 'Тип кнопки',
                                            example: 2
                                        ),
                                        new OA\Property(
                                            property: 'name',
                                            type: 'string',
                                            description: 'Название кнопки',
                                            example: 'Кнопка ссылка куда-то'
                                        ),
                                        new OA\Property(
                                            property: 'button_message_text',
                                            type: 'string',
                                            description: 'Текст сообщения кнопки',
                                            example: 'Нажми меня'
                                        ),
                                        new OA\Property(
                                            property: 'url',
                                            type: 'string',
                                            nullable: true,
                                            description: 'Ссылка кнопки (обязательна, если не указан chat_widget_id)',
                                            example: 'https://google.com'
                                        ),
                                        new OA\Property(
                                            property: 'chat_widget_id',
                                            type: 'integer',
                                            nullable: true,
                                            description: 'ID виджета (обязателен, если не указана ссылка)',
                                            example: 1
                                        ),
                                        new OA\Property(
                                            property: 'chat_answer_button_entities',
                                            type: 'array',
                                            description: 'Параметры кнопки для передачи в виджет',
                                            items: new OA\Items(
                                                type: 'object',
                                                required: ['name', 'code', 'param_name', 'multiple'],
                                                properties: [
                                                    new OA\Property(
                                                        property: 'name',
                                                        type: 'string',
                                                        description: 'Название сущности',
                                                        example: 'Тип топлива'
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
                                                ]
                                            )
                                        ),
                                    ]
                                )
                            ),
                        ]
                    )
                )
            ),
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Успешная операция',
                    content: new OA\JsonContent(
                        type: 'object',
                        properties: [
                            new OA\Property(
                                property: 'success',
                                type: 'boolean',
                                description: 'Успешность выполнения операции',
                                example: true
                            ),
                        ]
                    )
                ),
            ],
        );
    }
}
