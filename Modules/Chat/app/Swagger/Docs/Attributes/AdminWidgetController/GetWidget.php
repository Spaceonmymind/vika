<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetWidget extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/admin/chat/widgets/{widget_id}/get",
            operationId: "getWidget",
            summary: "Получить информацию о виджете",
            tags: ["AdminWidgetController"],
            parameters: [
                new OA\Parameter(
                    name: "widget_id",
                    in: "path",
                    required: true,
                    schema: new OA\Schema(type: "integer"),
                    description: "ID виджета"
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
                                property: "id",
                                type: "integer",
                                description: "ID виджета",
                                example: 4
                            ),
                            new OA\Property(
                                property: "code_name",
                                type: "string",
                                description: "Кодовое имя виджета",
                                example: "vi-business-help"
                            ),
                            new OA\Property(
                                property: "name",
                                type: "string",
                                description: "Название виджета",
                                example: "Меры поддержки предпринимателей"
                            ),
                            new OA\Property(
                                property: "description",
                                type: "string",
                                nullable: true,
                                description: "Описание виджета",
                                example: "Узнать чем может помочь государство предпринимателю"
                            ),
                            new OA\Property(
                                property: "is_active",
                                type: "boolean",
                                description: "Активен ли виджет",
                                example: true
                            ),
                            new OA\Property(
                                property: "type_id",
                                type: "integer",
                                description: "ID типа виджета",
                                example: 1
                            ),
                            new OA\Property(
                                property: "icon_id",
                                type: "integer",
                                nullable: true,
                                description: "ID иконки",
                                example: 1
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
                                description: "Цвет фона виджета",
                                example: null
                            ),
                            new OA\Property(
                                property: "usage_count",
                                type: "integer",
                                description: "Количество использований виджета",
                                example: 3
                            ),
                            new OA\Property(
                                property: "icon",
                                type: "object",
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
                                    )
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
                                    )
                                ]
                            ),
                            new OA\Property(
                                property: "attached_to_vika_type_widgets",
                                type: "array",
                                description: "Привязанные к типам Вики виджеты",
                                items: new OA\Items(
                                    type: "object",
                                    properties: [
                                        new OA\Property(
                                            property: "id",
                                            type: "integer",
                                            description: "ID привязки",
                                            example: 3
                                        ),
                                        new OA\Property(
                                            property: "chat_widget_id",
                                            type: "integer",
                                            description: "ID виджета",
                                            example: 4
                                        ),
                                        new OA\Property(
                                            property: "vika_type_id",
                                            type: "integer",
                                            description: "ID типа Вики",
                                            example: 5
                                        ),
                                        new OA\Property(
                                            property: "category_id",
                                            type: "integer",
                                            nullable: true,
                                            description: "ID категории",
                                            example: 3
                                        ),
                                        new OA\Property(
                                            property: "order",
                                            type: "integer",
                                            description: "Порядок",
                                            example: 1
                                        ),
                                        new OA\Property(
                                            property: "category",
                                            type: "object",
                                            nullable: true,
                                            description: "Категория виджета",
                                            properties: [
                                                new OA\Property(
                                                    property: "id",
                                                    type: "integer",
                                                    description: "ID категории",
                                                    example: 3
                                                ),
                                                new OA\Property(
                                                    property: "name",
                                                    type: "string",
                                                    description: "Название категории",
                                                    example: "Меры поддержки"
                                                ),
                                                new OA\Property(
                                                    property: "description",
                                                    type: "string",
                                                    description: "Описание категории",
                                                    example: "Узнать о мерах поддержки, оказываемых разным категориям граждан"
                                                ),
                                                new OA\Property(
                                                    property: "icon_id",
                                                    type: "integer",
                                                    description: "ID иконки",
                                                    example: 1
                                                ),
                                                new OA\Property(
                                                    property: "vika_type_id",
                                                    type: "integer",
                                                    description: "ID типа Вики",
                                                    example: 5
                                                ),
                                                new OA\Property(
                                                    property: "order",
                                                    type: "integer",
                                                    description: "Порядок",
                                                    example: 500
                                                ),
                                                new OA\Property(
                                                    property: "bg_colour",
                                                    type: "string",
                                                    description: "Цвет фона категории",
                                                    example: "#000000"
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
                                                        )
                                                    ]
                                                )
                                            ]
                                        ),
                                        new OA\Property(
                                            property: "vika_type",
                                            type: "object",
                                            description: "Тип Вики",
                                            properties: [
                                                new OA\Property(
                                                    property: "id",
                                                    type: "integer",
                                                    description: "ID типа Вики",
                                                    example: 5
                                                ),
                                                new OA\Property(
                                                    property: "name",
                                                    type: "string",
                                                    description: "Название типа Вики",
                                                    example: "test"
                                                ),
                                                new OA\Property(
                                                    property: "description",
                                                    type: "string",
                                                    description: "Описание типа Вики",
                                                    example: "Тестовый тип Вики"
                                                ),
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
