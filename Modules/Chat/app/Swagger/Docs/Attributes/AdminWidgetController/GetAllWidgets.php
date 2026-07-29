<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetAllWidgets extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/widgets/list',
            operationId: 'getAllWidgets',
            summary: 'Получить список всех виджетов',
            tags: ['AdminWidgetController','AdminVikaTypeController'],
            parameters: [
                new OA\Parameter(
                    name: 'exclude_vika_types[]',
                    in: 'query',
                    schema: new OA\Schema(
                        type: 'array',
                        items: new OA\Items(type: 'integer')
                    ),
                    description: 'Исключить виджеты, связанные с указанными типами Вики',
                    example: [5],
                ),
                new OA\Parameter(
                    name: 'include_vika_types[]',
                    in: 'query',
                    schema: new OA\Schema(
                        type: 'array',
                        items: new OA\Items(type: 'integer')
                    ),
                    description: 'Включить только виджеты, связанные с указанными типами Вики',
                    example: [5],
                ),
                new OA\Parameter(
                    name: 'is_active',
                    in: 'query',
                    schema: new OA\Schema(type: 'integer'),
                    description: 'Фильтр по активности виджета 1-активный, 0-неактивный, не передаётся - все',
                    example: 1,
                ),
                new OA\Parameter(
                    name: 'type_id',
                    in: 'query',
                    schema: new OA\Schema(type: 'integer'),
                    description: 'Фильтр по типу виджета',
                    example: 1,
                ),
                new OA\Parameter(
                    name: 'need_pagination',
                    in: 'query',
                    schema: new OA\Schema(type: 'integer'),
                    description: 'Флаг необходимости пагинации',
                    example: 1,
                ),
                new OA\Parameter(
                    name: 'per_page',
                    in: 'query',
                    schema: new OA\Schema(type: 'integer'),
                    description: 'Количество элементов на странице',
                    example: 30,
                ),
                new OA\Parameter(
                    name: 'query',
                    in: 'query',
                    schema: new OA\Schema(type: 'string'),
                    description: 'Поиск по названию, либо коду виджета',
                    example: 'подд',
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Успешная операция',
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
                                            description: 'Объект описания виджета',
                                            title: 'Виджет',
                                            properties: [
                                                new OA\Property(
                                                    property: 'id',
                                                    type: 'integer',
                                                    description: 'ID виджета',
                                                    example: 4,
                                                ),
                                                new OA\Property(
                                                    property: 'code_name',
                                                    type: 'string',
                                                    description: 'Код виджета',
                                                    example: 'vi-business-help',
                                                ),
                                                new OA\Property(
                                                    property: 'name',
                                                    type: 'string',
                                                    description: 'Название виджета',
                                                    example: 'Меры поддержки предпринимателей',
                                                ),
                                                new OA\Property(
                                                    property: 'description',
                                                    type: 'string',
                                                    description: 'Описание виджета',
                                                    example: 'Узнать чем может помочь государство предпринимателю',
                                                ),
                                                new OA\Property(
                                                    property: 'is_active',
                                                    type: 'boolean',
                                                    description: 'Активность виджета',
                                                    example: true,
                                                ),
                                                new OA\Property(
                                                    property: 'type_id',
                                                    type: 'integer',
                                                    description: 'ID типа виджета',
                                                    example: 1,
                                                ),
                                                new OA\Property(
                                                    property: 'icon_id',
                                                    type: 'integer',
                                                    description: 'ID иконки',
                                                    example: 1,
                                                ),
                                                new OA\Property(
                                                    property: 'bg_colour',
                                                    type: 'string',
                                                    nullable: true,
                                                    description: 'Цвет фона иконки виджета',
                                                    example: '#000000',
                                                ),
                                                new OA\Property(
                                                    property: 'icon',
                                                    type: 'object',
                                                    description: 'Иконка виджета',
                                                    properties: [
                                                        new OA\Property(
                                                            property: 'id',
                                                            type: 'integer',
                                                            description: 'ID иконки',
                                                            example: 1,
                                                        ),
                                                        new OA\Property(
                                                            property: 'code',
                                                            type: 'string',
                                                            description: 'Код иконки',
                                                            example: 'support-measures',
                                                        ),
                                                        new OA\Property(
                                                            property: 'name',
                                                            type: 'string',
                                                            description: 'Название иконки',
                                                            example: 'Вопрос',
                                                        ),
                                                    ],
                                                ),
                                                new OA\Property(
                                                    property: 'type',
                                                    type: 'object',
                                                    description: 'Тип виджета',
                                                    properties: [
                                                        new OA\Property(
                                                            property: 'id',
                                                            type: 'integer',
                                                            description: 'ID типа',
                                                            example: 1,
                                                        ),
                                                        new OA\Property(
                                                            property: 'code',
                                                            type: 'string',
                                                            description: 'Код типа',
                                                            example: 'internal',
                                                        ),
                                                        new OA\Property(
                                                            property: 'name',
                                                            type: 'string',
                                                            description: 'Название типа',
                                                            example: 'Внутренний',
                                                        ),
                                                    ],
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
