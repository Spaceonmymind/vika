<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminVikaTypeController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetVikaTypeWidgetMenu extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/admin/chat/vika_types/{vika_type_id}/get_menu",
            operationId: "getVikaTypeWidgetMenu",
            summary: "Получить меню виджетов и категорий для типа Вики",
            tags: ["AdminVikaTypeController","AdminWidgetController"],
            parameters: [
                new OA\Parameter(
                    name: "vika_type_id",
                    in: "path",
                    required: true,
                    schema: new OA\Schema(
                        type: "integer"
                    ),
                    description: "ID типа Вики"
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Успешная операция",
                    content: new OA\JsonContent(
                        type: "array",
                        items: new OA\Items(
                            anyOf: [
                                new OA\Schema(
                                    type: "object",
                                    description: "Категория виджетов",
                                    properties: [
                                        new OA\Property(
                                            property: "id",
                                            type: "integer",
                                            description: "ID категории",
                                            example: 6
                                        ),
                                        new OA\Property(
                                            property: "name",
                                            type: "string",
                                            description: "Название категории",
                                            example: "Новая категория"
                                        ),
                                        new OA\Property(
                                            property: "description",
                                            type: "string",
                                            description: "Описание категории",
                                            example: "Описание"
                                        ),
                                        new OA\Property(
                                            property: "icon_id",
                                            type: "integer",
                                            description: "ID иконки",
                                            example: 2
                                        ),
                                        new OA\Property(
                                            property: "vika_type_id",
                                            type: "integer",
                                            description: "ID типа Вики",
                                            example: 1
                                        ),
                                        new OA\Property(
                                            property: "order",
                                            type: "integer",
                                            description: "Порядок сортировки",
                                            example: 1
                                        ),
                                        new OA\Property(
                                            property: "bg_colour",
                                            type: "string",
                                            description: "Цвет фона",
                                            example: "#BE1616"
                                        ),
                                        new OA\Property(
                                            property: "is_favorite",
                                            type: "boolean",
                                            description: "Избранная категория",
                                            example: true
                                        ),
                                        new OA\Property(
                                            property: "icon",
                                            type: "object",
                                            description: "Иконка категории",
                                            properties: [
                                                new OA\Property(
                                                    property: "id",
                                                    type: "integer",
                                                    description: "ID иконки",
                                                    example: 2
                                                ),
                                                new OA\Property(
                                                    property: "code",
                                                    type: "string",
                                                    description: "Код иконки",
                                                    example: "education"
                                                ),
                                                new OA\Property(
                                                    property: "name",
                                                    type: "string",
                                                    description: "Название иконки",
                                                    example: "Образование"
                                                ),
                                            ]
                                        ),
                                        new OA\Property(
                                            property: "attached_to_vika_type_widgets",
                                            type: "array",
                                            description: "Привязанные к категории виджеты",
                                            items: new OA\Items(
                                                type: "object",
                                                properties: [
                                                    new OA\Property(
                                                        property: "id",
                                                        type: "integer",
                                                        description: "ID привязки",
                                                        example: 4
                                                    ),
                                                    new OA\Property(
                                                        property: "chat_widget_id",
                                                        type: "integer",
                                                        description: "ID виджета",
                                                        example: 1
                                                    ),
                                                    new OA\Property(
                                                        property: "vika_type_id",
                                                        type: "integer",
                                                        description: "ID типа Вики",
                                                        example: 1
                                                    ),
                                                    new OA\Property(
                                                        property: "category_id",
                                                        type: "integer",
                                                        description: "ID категории",
                                                        example: 6
                                                    ),
                                                    new OA\Property(
                                                        property: "order",
                                                        type: "integer",
                                                        description: "Порядок сортировки",
                                                        example: 1
                                                    ),
                                                    new OA\Property(
                                                        property: "is_favorite",
                                                        type: "boolean",
                                                        description: "Показывать ли в меню быстрого доступа",
                                                        example: true
                                                    ),
                                                    new OA\Property(
                                                        property: "widget",
                                                        type: "object",
                                                        description: "Информация о виджете",
                                                        properties: [
                                                            new OA\Property(
                                                                property: "id",
                                                                type: "integer",
                                                                description: "ID виджета",
                                                                example: 1
                                                            ),
                                                            new OA\Property(
                                                                property: "type_id",
                                                                type: "integer",
                                                                description: "ID типа виджета",
                                                                example: 1
                                                            ),
                                                            new OA\Property(
                                                                property: "code_name",
                                                                type: "string",
                                                                description: "Кодовое имя виджета",
                                                                example: "vi-gas"
                                                            ),
                                                            new OA\Property(
                                                                property: "name",
                                                                type: "string",
                                                                description: "Название виджета",
                                                                example: "Цены на топливо"
                                                            ),
                                                            new OA\Property(
                                                                property: "description",
                                                                type: "string",
                                                                description: "Описание виджета",
                                                                example: "Узнать где самый дешевый бензин"
                                                            ),
                                                            new OA\Property(
                                                                property: "url",
                                                                type: "string",
                                                                nullable: true,
                                                                description: "URL виджета",
                                                                example: null
                                                            ),
                                                            new OA\Property(
                                                                property: "bg_colour",
                                                                type: "string",
                                                                nullable: true,
                                                                description: "Цвет фона",
                                                                example: null
                                                            ),
                                                            new OA\Property(
                                                                property: "icon_id",
                                                                type: "integer",
                                                                nullable: true,
                                                                description: "ID иконки",
                                                                example: 1
                                                            ),
                                                            new OA\Property(
                                                                property: "is_active",
                                                                type: "boolean",
                                                                description: "Активен ли виджет",
                                                                example: true
                                                            ),
                                                            new OA\Property(
                                                                property: "icon",
                                                                type: "object",
                                                                nullable: true,
                                                                description: "Иконка виджета",
                                                                properties: [
                                                                    new OA\Property(
                                                                        property: "id",
                                                                        type: "integer",
                                                                        description: "ID иконки",
                                                                        example: 1
                                                                    ),
                                                                    new OA\Property(
                                                                        property: "code",
                                                                        type: "string",
                                                                        description: "Код иконки",
                                                                        example: "support-measures"
                                                                    ),
                                                                    new OA\Property(
                                                                        property: "name",
                                                                        type: "string",
                                                                        description: "Название иконки",
                                                                        example: "Вопрос"
                                                                    ),
                                                                ]
                                                            ),
                                                            new OA\Property(
                                                                property: "type",
                                                                type: "object",
                                                                description: "Тип виджета",
                                                                properties: [
                                                                    new OA\Property(
                                                                        property: "id",
                                                                        type: "integer",
                                                                        description: "ID типа",
                                                                        example: 1
                                                                    ),
                                                                    new OA\Property(
                                                                        property: "code",
                                                                        type: "string",
                                                                        description: "Код типа",
                                                                        example: "internal"
                                                                    ),
                                                                    new OA\Property(
                                                                        property: "name",
                                                                        type: "string",
                                                                        description: "Название типа",
                                                                        example: "Внутренний"
                                                                    ),
                                                                ]
                                                            ),
                                                        ]
                                                    ),
                                                ]
                                            )
                                        ),
                                        new OA\Property(
                                            property: "is_widget",
                                            type: "boolean",
                                            description: "Является ли элемент меню виджетом",
                                            example: false
                                        ),
                                    ]
                                ),
                                new OA\Schema(
                                    type: "object",
                                    description: "Привязка виджета",
                                    properties: [
                                        new OA\Property(
                                            property: "id",
                                            type: "integer",
                                            description: "ID привязки",
                                            example: 5
                                        ),
                                        new OA\Property(
                                            property: "chat_widget_id",
                                            type: "integer",
                                            description: "ID виджета",
                                            example: 2
                                        ),
                                        new OA\Property(
                                            property: "vika_type_id",
                                            type: "integer",
                                            description: "ID типа Вики",
                                            example: 1
                                        ),
                                        new OA\Property(
                                            property: "category_id",
                                            type: "integer",
                                            nullable: true,
                                            description: "ID категории",
                                            example: null
                                        ),
                                        new OA\Property(
                                            property: "order",
                                            type: "integer",
                                            description: "Порядок сортировки",
                                            example: 1
                                        ),
                                        new OA\Property(
                                            property: "is_favorite",
                                            type: "boolean",
                                            description: "Показывать ли виджет в меню быстрого доступа",
                                            example: false
                                        ),
                                        new OA\Property(
                                            property: "widget",
                                            type: "object",
                                            description: "Информация о виджете",
                                            properties: [
                                                new OA\Property(
                                                    property: "id",
                                                    type: "integer",
                                                    description: "ID виджета",
                                                    example: 2
                                                ),
                                                new OA\Property(
                                                    property: "type_id",
                                                    type: "integer",
                                                    description: "ID типа виджета",
                                                    example: 1
                                                ),
                                                new OA\Property(
                                                    property: "code_name",
                                                    type: "string",
                                                    description: "Кодовое имя виджета",
                                                    example: "vi-book"
                                                ),
                                                new OA\Property(
                                                    property: "name",
                                                    type: "string",
                                                    description: "Название виджета",
                                                    example: "Поиск контактов"
                                                ),
                                                new OA\Property(
                                                    property: "description",
                                                    type: "string",
                                                    description: "Описание виджета",
                                                    example: "Найти необходимый телефонный номер"
                                                ),
                                                new OA\Property(
                                                    property: "url",
                                                    type: "string",
                                                    nullable: true,
                                                    description: "URL виджета",
                                                    example: null
                                                ),
                                                new OA\Property(
                                                    property: "bg_colour",
                                                    type: "string",
                                                    nullable: true,
                                                    description: "Цвет фона",
                                                    example: null
                                                ),
                                                new OA\Property(
                                                    property: "icon_id",
                                                    type: "integer",
                                                    nullable: true,
                                                    description: "ID иконки",
                                                    example: null
                                                ),
                                                new OA\Property(
                                                    property: "is_active",
                                                    type: "boolean",
                                                    description: "Активен ли виджет",
                                                    example: true
                                                ),
                                                new OA\Property(
                                                    property: "icon",
                                                    type: "object",
                                                    nullable: true,
                                                    description: "Иконка виджета",
                                                    example: null
                                                ),
                                                new OA\Property(
                                                    property: "type",
                                                    type: "object",
                                                    description: "Тип виджета",
                                                    properties: [
                                                        new OA\Property(
                                                            property: "id",
                                                            type: "integer",
                                                            description: "ID типа",
                                                            example: 1
                                                        ),
                                                        new OA\Property(
                                                            property: "code",
                                                            type: "string",
                                                            description: "Код типа",
                                                            example: "internal"
                                                        ),
                                                        new OA\Property(
                                                            property: "name",
                                                            type: "string",
                                                            description: "Название типа",
                                                            example: "Внутренний"
                                                        ),
                                                    ]
                                                ),
                                            ]
                                        ),
                                        new OA\Property(
                                            property: "is_widget",
                                            type: "boolean",
                                            description: "Является ли элемент меню виджетом",
                                            example: true
                                        ),
                                    ]
                                ),
                            ]
                        )
                    )
                ),
            ],
        );
    }
}
