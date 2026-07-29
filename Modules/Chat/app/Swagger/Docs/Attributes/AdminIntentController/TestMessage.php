<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminIntentController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class TestMessage extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/intents/test',
            operationId: 'testMessage',
            summary: 'Проверить сообщение на определение интента',
            tags: ['AdminIntentController'],
            parameters: [
                new OA\Parameter(
                    name: 'text',
                    in: 'query',
                    required: true,
                    schema: new OA\Schema(
                        type: 'string',
                        example: 'Телефон ципорин'
                    ),
                    description: 'Текст сообщения, которое хочется протестировать'
                ),
                new OA\Parameter(
                    name: 'vika_type',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(
                        type: 'string',
                        example: 'main',
                        nullable: true
                    ),
                    description: 'Название типа Вики (опционально)'
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Результат тестирования сообщения (успешный)',
                    content: new OA\JsonContent(
                        type: 'object',
                        properties: [
                            new OA\Property(
                                property: 'success',
                                type: 'boolean',
                                description: 'Флаг успешного выполнения',
                                example: true
                            ),
                            new OA\Property(
                                property: 'response',
                                type: 'object',
                                description: 'Результат определения интента',
                                properties: [
                                    new OA\Property(
                                        property: 'intent',
                                        type: 'string',
                                        description: 'Код определённого интента',
                                        example: 'phonebook'
                                    ),
                                    new OA\Property(
                                        property: 'entities',
                                        type: 'array',
                                        description: 'Найденные сущности',
                                        items: new OA\Items(
                                            type: 'object',
                                            properties: [
                                                new OA\Property(
                                                    property: 'type',
                                                    type: 'string',
                                                    description: 'Тип сущности',
                                                    example: 'fio'
                                                ),
                                                new OA\Property(
                                                    property: 'value',
                                                    type: 'string',
                                                    description: 'Значение сущности',
                                                    example: 'ципорин'
                                                ),
                                                new OA\Property(
                                                    property: 'start',
                                                    type: 'integer',
                                                    description: 'Начальная позиция',
                                                    example: 8
                                                ),
                                                new OA\Property(
                                                    property: 'end',
                                                    type: 'integer',
                                                    description: 'Конечная позиция',
                                                    example: 15
                                                ),
                                            ]
                                        )
                                    ),
                                    new OA\Property(
                                        property: 'similarity',
                                        type: 'number',
                                        format: 'float',
                                        description: 'Оценка похожести текста с примером',
                                        example: 0.09995277068680519
                                    ),
                                    new OA\Property(
                                        property: 'sample_text',
                                        type: 'string',
                                        description: 'Пример текста для интента, по которому было определено сообщение',
                                        example: 'телефонный справочник'
                                    ),
                                    new OA\Property(
                                        property: 'sanitized_text',
                                        type: 'string',
                                        description: 'Нормализованный текст(без сущностей и персоналки)',
                                        example: 'Телефон ФИО'
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
                                                example: 44
                                            ),
                                            new OA\Property(
                                                property: 'code',
                                                type: 'string',
                                                description: 'Код интента',
                                                example: 'phonebook'
                                            ),
                                            new OA\Property(
                                                property: 'name',
                                                type: 'string',
                                                description: 'Название интента',
                                                example: 'Телефонный справочник'
                                            ),
                                        ]
                                    ),
                                ]
                            ),
                        ]
                    )
                )
            ]
        );
    }
}
