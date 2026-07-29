<?php

namespace Modules\Chat\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetWidgetsList extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/chat/get_widgets",
            operationId: "getWidgetsList",
            tags: ["Chat"],
            summary: "Получить список виджетов и категорий",
            parameters: [
                new OA\Parameter(
                    name: "vika_type",
                    in: "query",
                    required: false,
                    description: "Тип вики",
                    schema: new OA\Schema(
                        type: "string",
                        description: "Код типа Вики"
                    )
                )
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Успешная операция",
                    content: new OA\JsonContent(
                        type: "object",
                        properties: [
                            new OA\Property(
                                property: "favorite",
                                type: "array",
                                description: "Элементы меню быстрого доступа(избранного)",
                                items: new OA\Items(
                                    anyOf: [
                                        // Категория
                                        new OA\Schema(
                                            type: "object",
                                            description: "Категория виджетов",
                                            properties: [
                                                new OA\Property(
                                                    property: "id",
                                                    type: "integer",
                                                    example: 5,
                                                    description: "ID категории"
                                                ),
                                                new OA\Property(
                                                    property: "name",
                                                    type: "string",
                                                    example: "Меры поддержки",
                                                    description: "Название категории"
                                                ),
                                                new OA\Property(
                                                    property: "description",
                                                    type: "string",
                                                    example: "Узнать о мерах поддержки, оказываемых разным категориям граждан",
                                                    description: "Описание категории"
                                                ),
                                                new OA\Property(
                                                    property: "icon_id",
                                                    type: "integer",
                                                    example: 1,
                                                    description: "ID иконки"
                                                ),
                                                new OA\Property(
                                                    property: "vika_type_id",
                                                    type: "integer",
                                                    example: 1,
                                                    description: "ID типа Вики"
                                                ),
                                                new OA\Property(
                                                    property: "order",
                                                    type: "integer",
                                                    example: 100,
                                                    description: "Порядок сортировки"
                                                ),
                                                new OA\Property(
                                                    property: "bg_colour",
                                                    type: "string",
                                                    example: "#000000",
                                                    description: "Цвет фона"
                                                ),
                                                new OA\Property(
                                                    property: "is_favorite",
                                                    type: "boolean",
                                                    example: true,
                                                    description: "Признак избранного"
                                                ),
                                                new OA\Property(
                                                    property: "icon",
                                                    type: "object",
                                                    description: "Иконка категории",
                                                    properties: [
                                                        new OA\Property(
                                                            property: "id",
                                                            type: "integer",
                                                            example: 1,
                                                            description: "ID иконки"
                                                        ),
                                                        new OA\Property(
                                                            property: "code",
                                                            type: "string",
                                                            example: "support-measures",
                                                            description: "Код иконки"
                                                        ),
                                                        new OA\Property(
                                                            property: "name",
                                                            type: "string",
                                                            example: "Вопрос",
                                                            description: "Название иконки"
                                                        )
                                                    ]
                                                ),
                                                new OA\Property(
                                                    property: "is_widget",
                                                    type: "boolean",
                                                    example: false,
                                                    description: "Признак, что объект является виджетом((true- виджет, false- категория)"
                                                )
                                            ]
                                        ),
                                        // Привязка виджета
                                        new OA\Schema(
                                            type: "object",
                                            description: "Привязка виджета",
                                            properties: [
                                                new OA\Property(
                                                    property: "id",
                                                    type: "integer",
                                                    example: 4,
                                                    description: "ID привязки"
                                                ),
                                                new OA\Property(
                                                    property: "chat_widget_id",
                                                    type: "integer",
                                                    example: 1,
                                                    description: "ID виджета"
                                                ),
                                                new OA\Property(
                                                    property: "vika_type_id",
                                                    type: "integer",
                                                    example: 1,
                                                    description: "ID типа Вики"
                                                ),
                                                new OA\Property(
                                                    property: "category_id",
                                                    type: "integer",
                                                    nullable: true,
                                                    example: 5,
                                                    description: "ID категории"
                                                ),
                                                new OA\Property(
                                                    property: "order",
                                                    type: "integer",
                                                    example: 1,
                                                    description: "Порядок сортировки"
                                                ),
                                                new OA\Property(
                                                    property: "is_favorite",
                                                    type: "boolean",
                                                    example: true,
                                                    description: "Признак избранного"
                                                ),
                                                new OA\Property(
                                                    property: "widget",
                                                    type: "object",
                                                    description: "Данные виджета",
                                                    properties: [
                                                        new OA\Property(
                                                            property: "id",
                                                            type: "integer",
                                                            example: 1,
                                                            description: "ID виджета"
                                                        ),
                                                        new OA\Property(
                                                            property: "type_id",
                                                            type: "integer",
                                                            example: 1,
                                                            description: "ID типа виджета"
                                                        ),
                                                        new OA\Property(
                                                            property: "code_name",
                                                            type: "string",
                                                            example: "vi-gas",
                                                            description: "Кодовое имя виджета"
                                                        ),
                                                        new OA\Property(
                                                            property: "name",
                                                            type: "string",
                                                            example: "Цены на топливо",
                                                            description: "Название виджета"
                                                        ),
                                                        new OA\Property(
                                                            property: "description",
                                                            type: "string",
                                                            example: "Узнать где самый дешевый бензин",
                                                            description: "Описание виджета"
                                                        ),
                                                        new OA\Property(
                                                            property: "url",
                                                            type: "string",
                                                            nullable: true,
                                                            example: null,
                                                            description: "URL виджета"
                                                        ),
                                                        new OA\Property(
                                                            property: "bg_colour",
                                                            type: "string",
                                                            nullable: true,
                                                            example: null,
                                                            description: "Цвет фона"
                                                        ),
                                                        new OA\Property(
                                                            property: "icon_id",
                                                            type: "integer",
                                                            nullable: true,
                                                            example: null,
                                                            description: "ID иконки"
                                                        ),
                                                        new OA\Property(
                                                            property: "is_active",
                                                            type: "boolean",
                                                            example: true,
                                                            description: "Активен ли виджет"
                                                        ),
                                                        new OA\Property(
                                                            property: "icon",
                                                            type: "object",
                                                            nullable: true,
                                                            example: null,
                                                            description: "Иконка виджета"
                                                        ),
                                                        new OA\Property(
                                                            property: "type",
                                                            type: "object",
                                                            description: "Тип виджета",
                                                            properties: [
                                                                new OA\Property(
                                                                    property: "id",
                                                                    type: "integer",
                                                                    example: 1,
                                                                    description: "ID типа"
                                                                ),
                                                                new OA\Property(
                                                                    property: "code",
                                                                    type: "string",
                                                                    example: "internal",
                                                                    description: "Код типа"
                                                                ),
                                                                new OA\Property(
                                                                    property: "name",
                                                                    type: "string",
                                                                    example: "Внутренний",
                                                                    description: "Название типа"
                                                                )
                                                            ]
                                                        )
                                                    ]
                                                ),
                                                new OA\Property(
                                                    property: "is_widget",
                                                    type: "boolean",
                                                    example: true,
                                                    description: "Признак, что объект — виджет"
                                                )
                                            ]
                                        )
                                    ]
                                )
                            ),
                            new OA\Property(
                                property: "widgets_and_categories",
                                type: "array",
                                description: "Элементы меню виджетов",
                                items: new OA\Items(
                                    oneOf: [
                                        // Категория (с attached_to_vika_type_widgets)
                                        new OA\Schema(
                                            type: "object",
                                            description: "Категория с привязанными виджетами",
                                            properties: [
                                                new OA\Property(
                                                    property: "id",
                                                    type: "integer",
                                                    example: 5,
                                                    description: "ID категории"
                                                ),
                                                new OA\Property(
                                                    property: "name",
                                                    type: "string",
                                                    example: "Меры поддержки",
                                                    description: "Название категории"
                                                ),
                                                new OA\Property(
                                                    property: "description",
                                                    type: "string",
                                                    example: "Узнать о мерах поддержки, оказываемых разным категориям граждан",
                                                    description: "Описание категории"
                                                ),
                                                new OA\Property(
                                                    property: "icon_id",
                                                    type: "integer",
                                                    example: 1,
                                                    description: "ID иконки"
                                                ),
                                                new OA\Property(
                                                    property: "vika_type_id",
                                                    type: "integer",
                                                    example: 1,
                                                    description: "ID типа Вики"
                                                ),
                                                new OA\Property(
                                                    property: "order",
                                                    type: "integer",
                                                    example: 100,
                                                    description: "Порядок сортировки"
                                                ),
                                                new OA\Property(
                                                    property: "bg_colour",
                                                    type: "string",
                                                    example: "#000000",
                                                    description: "Цвет фона"
                                                ),
                                                new OA\Property(
                                                    property: "is_favorite",
                                                    type: "boolean",
                                                    example: true,
                                                    description: "Признак избранного"
                                                ),
                                                new OA\Property(
                                                    property: "icon",
                                                    type: "object",
                                                    description: "Иконка категории",
                                                    properties: [
                                                        new OA\Property(
                                                            property: "id",
                                                            type: "integer",
                                                            example: 1,
                                                            description: "ID иконки"
                                                        ),
                                                        new OA\Property(
                                                            property: "code",
                                                            type: "string",
                                                            example: "support-measures",
                                                            description: "Код иконки"
                                                        ),
                                                        new OA\Property(
                                                            property: "name",
                                                            type: "string",
                                                            example: "Вопрос",
                                                            description: "Название иконки"
                                                        )
                                                    ]
                                                ),
                                                new OA\Property(
                                                    property: "attached_to_vika_type_widgets",
                                                    type: "array",
                                                    description: "Привязанные виджеты",
                                                    items: new OA\Items(
                                                        type: "object",
                                                        properties: [
                                                            new OA\Property(
                                                                property: "id",
                                                                type: "integer",
                                                                example: 4,
                                                                description: "ID привязки"
                                                            ),
                                                            new OA\Property(
                                                                property: "chat_widget_id",
                                                                type: "integer",
                                                                example: 1,
                                                                description: "ID виджета"
                                                            ),
                                                            new OA\Property(
                                                                property: "vika_type_id",
                                                                type: "integer",
                                                                example: 1,
                                                                description: "ID типа Вики"
                                                            ),
                                                            new OA\Property(
                                                                property: "category_id",
                                                                type: "integer",
                                                                example: 5,
                                                                description: "ID категории"
                                                            ),
                                                            new OA\Property(
                                                                property: "order",
                                                                type: "integer",
                                                                example: 1,
                                                                description: "Порядок сортировки"
                                                            ),
                                                            new OA\Property(
                                                                property: "is_favorite",
                                                                type: "boolean",
                                                                example: true,
                                                                description: "Признак избранного"
                                                            ),
                                                            new OA\Property(
                                                                property: "widget",
                                                                type: "object",
                                                                description: "Данные виджета",
                                                                properties: [
                                                                    new OA\Property(
                                                                        property: "id",
                                                                        type: "integer",
                                                                        example: 1,
                                                                        description: "ID виджета"
                                                                    ),
                                                                    new OA\Property(
                                                                        property: "type_id",
                                                                        type: "integer",
                                                                        example: 1,
                                                                        description: "ID типа виджета"
                                                                    ),
                                                                    new OA\Property(
                                                                        property: "code_name",
                                                                        type: "string",
                                                                        example: "vi-gas",
                                                                        description: "Кодовое имя виджета"
                                                                    ),
                                                                    new OA\Property(
                                                                        property: "name",
                                                                        type: "string",
                                                                        example: "Цены на топливо",
                                                                        description: "Название виджета"
                                                                    ),
                                                                    new OA\Property(
                                                                        property: "description",
                                                                        type: "string",
                                                                        example: "Узнать где самый дешевый бензин",
                                                                        description: "Описание виджета"
                                                                    ),
                                                                    new OA\Property(
                                                                        property: "url",
                                                                        type: "string",
                                                                        nullable: true,
                                                                        example: null,
                                                                        description: "URL виджета"
                                                                    ),
                                                                    new OA\Property(
                                                                        property: "bg_colour",
                                                                        type: "string",
                                                                        nullable: true,
                                                                        example: null,
                                                                        description: "Цвет фона"
                                                                    ),
                                                                    new OA\Property(
                                                                        property: "icon_id",
                                                                        type: "integer",
                                                                        nullable: true,
                                                                        example: null,
                                                                        description: "ID иконки"
                                                                    ),
                                                                    new OA\Property(
                                                                        property: "is_active",
                                                                        type: "boolean",
                                                                        example: true,
                                                                        description: "Активен ли виджет"
                                                                    ),
                                                                    new OA\Property(
                                                                        property: "icon",
                                                                        type: "object",
                                                                        nullable: true,
                                                                        example: null,
                                                                        description: "Иконка виджета"
                                                                    ),
                                                                    new OA\Property(
                                                                        property: "type",
                                                                        type: "object",
                                                                        description: "Тип виджета",
                                                                        properties: [
                                                                            new OA\Property(
                                                                                property: "id",
                                                                                type: "integer",
                                                                                example: 1,
                                                                                description: "ID типа"
                                                                            ),
                                                                            new OA\Property(
                                                                                property: "code",
                                                                                type: "string",
                                                                                example: "internal",
                                                                                description: "Код типа"
                                                                            ),
                                                                            new OA\Property(
                                                                                property: "name",
                                                                                type: "string",
                                                                                example: "Внутренний",
                                                                                description: "Название типа"
                                                                            )
                                                                        ]
                                                                    )
                                                                ]
                                                            )
                                                        ]
                                                    )
                                                ),
                                                new OA\Property(
                                                    property: "is_widget",
                                                    type: "boolean",
                                                    example: false,
                                                    description: "Признак, что объект является виджетом((true- виджет, false- категория)"
                                                )
                                            ]
                                        ),
                                        // Привязка виджета
                                        new OA\Schema(
                                            type: "object",
                                            description: "Привязка виджета",
                                            properties: [
                                                new OA\Property(
                                                    property: "id",
                                                    type: "integer",
                                                    example: 4,
                                                    description: "ID привязки"
                                                ),
                                                new OA\Property(
                                                    property: "chat_widget_id",
                                                    type: "integer",
                                                    example: 1,
                                                    description: "ID виджета"
                                                ),
                                                new OA\Property(
                                                    property: "vika_type_id",
                                                    type: "integer",
                                                    example: 1,
                                                    description: "ID типа Вики"
                                                ),
                                                new OA\Property(
                                                    property: "category_id",
                                                    type: "integer",
                                                    nullable: true,
                                                    example: 5,
                                                    description: "ID категории"
                                                ),
                                                new OA\Property(
                                                    property: "order",
                                                    type: "integer",
                                                    example: 1,
                                                    description: "Порядок сортировки"
                                                ),
                                                new OA\Property(
                                                    property: "is_favorite",
                                                    type: "boolean",
                                                    example: true,
                                                    description: "Признак избранного"
                                                ),
                                                new OA\Property(
                                                    property: "widget",
                                                    type: "object",
                                                    description: "Данные виджета",
                                                    properties: [
                                                        new OA\Property(
                                                            property: "id",
                                                            type: "integer",
                                                            example: 1,
                                                            description: "ID виджета"
                                                        ),
                                                        new OA\Property(
                                                            property: "type_id",
                                                            type: "integer",
                                                            example: 1,
                                                            description: "ID типа виджета"
                                                        ),
                                                        new OA\Property(
                                                            property: "code_name",
                                                            type: "string",
                                                            example: "vi-gas",
                                                            description: "Кодовое имя виджета"
                                                        ),
                                                        new OA\Property(
                                                            property: "name",
                                                            type: "string",
                                                            example: "Цены на топливо",
                                                            description: "Название виджета"
                                                        ),
                                                        new OA\Property(
                                                            property: "description",
                                                            type: "string",
                                                            example: "Узнать где самый дешевый бензин",
                                                            description: "Описание виджета"
                                                        ),
                                                        new OA\Property(
                                                            property: "url",
                                                            type: "string",
                                                            nullable: true,
                                                            example: null,
                                                            description: "URL виджета"
                                                        ),
                                                        new OA\Property(
                                                            property: "bg_colour",
                                                            type: "string",
                                                            nullable: true,
                                                            example: null,
                                                            description: "Цвет фона"
                                                        ),
                                                        new OA\Property(
                                                            property: "icon_id",
                                                            type: "integer",
                                                            nullable: true,
                                                            example: null,
                                                            description: "ID иконки"
                                                        ),
                                                        new OA\Property(
                                                            property: "is_active",
                                                            type: "boolean",
                                                            example: true,
                                                            description: "Активен ли виджет"
                                                        ),
                                                        new OA\Property(
                                                            property: "icon",
                                                            type: "object",
                                                            nullable: true,
                                                            example: null,
                                                            description: "Иконка виджета"
                                                        ),
                                                        new OA\Property(
                                                            property: "type",
                                                            type: "object",
                                                            description: "Тип виджета",
                                                            properties: [
                                                                new OA\Property(
                                                                    property: "id",
                                                                    type: "integer",
                                                                    example: 1,
                                                                    description: "ID типа"
                                                                ),
                                                                new OA\Property(
                                                                    property: "code",
                                                                    type: "string",
                                                                    example: "internal",
                                                                    description: "Код типа"
                                                                ),
                                                                new OA\Property(
                                                                    property: "name",
                                                                    type: "string",
                                                                    example: "Внутренний",
                                                                    description: "Название типа"
                                                                )
                                                            ]
                                                        )
                                                    ]
                                                ),
                                                new OA\Property(
                                                    property: "is_widget",
                                                    type: "boolean",
                                                    example: true,
                                                    description: "Признак, что объект — виджет"
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

