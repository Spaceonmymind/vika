<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminIntentController;


use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetIntents extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/intents/list',
            operationId: 'getIntents',
            summary: 'Получить список интентов',
            tags: ['AdminIntentController'],
            parameters: [
                new OA\Parameter(
                    name: 'exclude_vika_type_id',
                    in: 'query',
                    schema: new OA\Schema(type: 'integer'),
                    description: 'Фильтр по типу Вики для исключения из списка',
                    example: 1,
                ),
                new OA\Parameter(
                    name: 'active',
                    in: 'query',
                    schema: new OA\Schema(type: 'integer'),
                    description: 'Какие ответы показывать: 1-Активные, 0-Неактивные, null-Все',
                    example: 1,
                ),
                new OA\Parameter(
                    name: 'need_pagination',
                    in: 'query',
                    schema: new OA\Schema(type: 'integer'),
                    description: 'Необходимость пагинации 1 - с пагинацией, 0 - без',
                    example: 1,
                ),
                new OA\Parameter(
                    name: 'name',
                    in: 'query',
                    schema: new OA\Schema(type: 'string'),
                    description: 'Фильтр по названию, либо коду интента',
                    example: 'de',
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
                    description: 'Success',
                    content: new OA\JsonContent(
                        type: 'array',
                        items: new OA\Items(
                            type: 'object',
                            description: 'Объект описания интента',
                            title: 'Интент',
                            properties: [
                                new OA\Property(
                                    property: 'id',
                                    type: 'integer',
                                    description: 'ID интента',
                                    example: 1
                                ),
                                new OA\Property(
                                    property: 'code',
                                    type: 'string',
                                    description: 'Код интента',
                                    example: 'dep_trud.ugras_employment'
                                ),
                                new OA\Property(
                                    property: 'name',
                                    type: 'string',
                                    description: 'Название интента',
                                    example: '[ДепТруд] Вызов виджета "Занятость в Югре"'
                                ),
                                new OA\Property(
                                    property: 'active',
                                    type: 'boolean',
                                    description: 'Активность интента',
                                    example: true
                                ),
                                new OA\Property(
                                    property: 'handler_id',
                                    type: 'integer',
                                    description: 'ID обработчика интента',
                                    example: 1
                                ),
                                new OA\Property(
                                    property: 'handler',
                                    type: 'object',
                                    description: 'Объект обработчика',
                                    properties: [
                                        new OA\Property(
                                            property: 'id',
                                            type: 'integer',
                                            description: 'ID обработчика',
                                            example: 1
                                        ),
                                        new OA\Property(
                                            property: 'code',
                                            type: 'string',
                                            description: 'Код обработчика',
                                            example: 'default'
                                        ),
                                        new OA\Property(
                                            property: 'name',
                                            type: 'string',
                                            description: 'Название обработчика',
                                            example: 'Стандартный'
                                        ),
                                    ]
                                ),
                            ]
                        )
                    )
                )
            ]
        );
    }
}
