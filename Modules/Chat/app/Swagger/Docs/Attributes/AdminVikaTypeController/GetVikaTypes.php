<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminVikaTypeController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetVikaTypes extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/vika_types/list',
            operationId: 'getVikaTypes',
            summary: 'Получить список типов вики',
            tags: ['AdminVikaTypeController', 'AdminWidgetController'],
            parameters: [
                new OA\Parameter(
                    name: 'need_pagination',
                    in: 'query',
                    required: false,
                    description: 'Флаг необходимости пагинации',
                    schema: new OA\Schema(type: 'integer', example: 0),
                ),
                new OA\Parameter(
                    name: 'per_page',
                    in: 'query',
                    required: false,
                    description: 'Количество элементов на странице (если пагинация включена)',
                    schema: new OA\Schema(type: 'integer', example: 30),
                ),
                new OA\Parameter(
                    name: 'exclude_widgets[]',
                    in: 'query',
                    required: false,
                    description: 'Исключить типы Вики, к которым уже привязаны определённые виджеты',
                    schema: new OA\Schema(
                        type: 'array',
                        items: new OA\Items(type: 'integer'),
                        example: [4],
                    ),
                ),
                new OA\Parameter(
                    name: 'query',
                    in: 'query',
                    required: false,
                    description: 'Поиск по названию, либо коду типа Вики',
                    schema: new OA\Schema(
                        type: 'string',
                        example: 'осн',
                    ),
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Success',
                    content: new OA\JsonContent(
                        type: "object",
                        allOf: [
                            new OA\Property(ref: '#/components/schemas/LengthAwarePaginator'),
                            new OA\Schema(
                                properties: [
                                    new OA\Property(
                                        property: 'data',
                                        type: 'array',
                                        items: new OA\Items(
                                            type: 'object',
                                            description: 'Объект описания типа Вики',
                                            title: 'Тип Вики',
                                            properties: [
                                                new OA\Property(
                                                    property: 'id',
                                                    type: 'integer',
                                                    description: 'ID Вики',
                                                    example: 1,
                                                ),
                                                new OA\Property(
                                                    property: 'name',
                                                    type: 'string',
                                                    description: 'Код Вики',
                                                    example: 'main',
                                                ),
                                                new OA\Property(
                                                    property: 'description',
                                                    type: 'string',
                                                    description: 'Название Вики',
                                                    example: 'Основной чат',
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
