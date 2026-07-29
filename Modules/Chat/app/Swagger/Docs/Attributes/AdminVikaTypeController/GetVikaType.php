<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminVikaTypeController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetVikaType extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/admin/chat/vika_types/{vika_type}/get",
            operationId: "getVikaType",
            summary: "Получить информацию о типе Вики",
            tags: ["AdminVikaTypeController"],
            parameters: [
                new OA\Parameter(
                    name: "vika_type",
                    in: "path",
                    required: true,
                    schema: new OA\Schema(type: "integer"),
                    description: "ID типа Вики",
                ),
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
                                description: "ID типа Вики",
                                example: 5,
                            ),
                            new OA\Property(
                                property: "name",
                                type: "string",
                                description: "Название типа Вики",
                                example: "test",
                            ),
                            new OA\Property(
                                property: "description",
                                type: "string",
                                description: "Описание типа Вики",
                                example: "Тестовый тип Вики",
                            ),
                            new OA\Property(
                                property: "widget_categories",
                                type: "array",
                                description: "Категории виджетов",
                                items: new OA\Items(
                                    type: "object",
                                    properties: [
                                        new OA\Property(
                                            property: "id",
                                            type: "integer",
                                            example: 2
                                        ),
                                        new OA\Property(
                                            property: "name",
                                            type: "string",
                                            example: "Меры поддержки"
                                        ),
                                        new OA\Property(
                                            property: "description",
                                            type: "string",
                                            example: "Узнать о мерах поддержки, оказываемых разным категориям граждан"
                                        ),
                                        new OA\Property(
                                            property: "icon_id",
                                            type: "integer",
                                            example: 1
                                        ),
                                        new OA\Property(
                                            property: "vika_type_id",
                                            type: "integer",
                                            example: 5
                                        ),
                                        new OA\Property(
                                            property: "order",
                                            type: "integer",
                                            example: 500
                                        ),
                                        new OA\Property(
                                            property: "bg_colour",
                                            type: "string",
                                            example: "#000000"
                                        ),
                                        new OA\Property(
                                            property: "icon",
                                            type: "object",
                                            properties: [
                                                new OA\Property(
                                                    property: "id",
                                                    type: "integer",
                                                    example: 1
                                                ),
                                                new OA\Property(
                                                    property: "code",
                                                    type: "string",
                                                    example: "support-measures"
                                                ),
                                                new OA\Property(
                                                    property: "name",
                                                    type: "string",
                                                    example: "Вопрос"
                                                ),
                                            ],
                                        ),
                                    ],
                                ),
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
                                            example: 2
                                        ),
                                        new OA\Property(
                                            property: "chat_widget_id",
                                            type: "integer",
                                            example: 4
                                        ),
                                        new OA\Property(
                                            property: "vika_type_id",
                                            type: "integer",
                                            example: 5
                                        ),
                                        new OA\Property(
                                            property: "category_id",
                                            type: "integer",
                                            example: 2
                                        ),
                                        new OA\Property(
                                            property: "order",
                                            type: "integer",
                                            example: 1
                                        ),
                                        new OA\Property(
                                            property: "category",
                                            type: "object",
                                            properties: [
                                                new OA\Property(
                                                    property: "id",
                                                    type: "integer",
                                                    example: 2
                                                ),
                                                new OA\Property(
                                                    property: "name",
                                                    type: "string",
                                                    example: "Меры поддержки"
                                                ),
                                                new OA\Property(
                                                    property: "description",
                                                    type: "string",
                                                    example: "Узнать о мерах поддержки, оказываемых разным категориям граждан"
                                                ),
                                                new OA\Property(
                                                    property: "icon_id",
                                                    type: "integer",
                                                    example: 1
                                                ),
                                                new OA\Property(
                                                    property: "vika_type_id",
                                                    type: "integer",
                                                    example: 5
                                                ),
                                                new OA\Property(
                                                    property: "order",
                                                    type: "integer",
                                                    example: 500
                                                ),
                                                new OA\Property(
                                                    property: "bg_colour",
                                                    type: "string",
                                                    example: "#000000"
                                                ),
                                            ],
                                        ),
                                        new OA\Property(
                                            property: "widget",
                                            type: "object",
                                            properties: [
                                                new OA\Property(
                                                    property: "id",
                                                    type: "integer",
                                                    example: 4
                                                ),
                                                new OA\Property(
                                                    property: "code_name",
                                                    type: "string",
                                                    example: "vi-business-help"
                                                ),
                                                new OA\Property(
                                                    property: "name",
                                                    type: "string",
                                                    example: "Меры поддержки предпринимателей"
                                                ),
                                                new OA\Property(
                                                    property: "description",
                                                    type: "string",
                                                    example: "Узнать чем может помочь государство предпринимателю"
                                                ),
                                                new OA\Property(
                                                    property: "is_active",
                                                    type: "boolean",
                                                    example: true
                                                ),
                                                new OA\Property(
                                                    property: "type_id",
                                                    type: "integer",
                                                    example: 1
                                                ),
                                                new OA\Property(
                                                    property: "icon_id",
                                                    type: "integer",
                                                    example: 1
                                                ),
                                                new OA\Property(
                                                    property: "url",
                                                    type: "string",
                                                    nullable: true,
                                                    example: null
                                                ),
                                                new OA\Property(
                                                    property: "bg_colour",
                                                    type: "string",
                                                    nullable: true,
                                                    example: null
                                                ),
                                                new OA\Property(
                                                    property: "icon",
                                                    type: "object",
                                                    properties: [
                                                        new OA\Property(
                                                            property: "id",
                                                            type: "integer",
                                                            example: 1
                                                        ),
                                                        new OA\Property(
                                                            property: "code",
                                                            type: "string",
                                                            example: "support-measures"
                                                        ),
                                                        new OA\Property(
                                                            property: "name",
                                                            type: "string",
                                                            example: "Вопрос"
                                                        ),
                                                    ],
                                                ),
                                                new OA\Property(
                                                    property: "type",
                                                    type: "object",
                                                    properties: [
                                                        new OA\Property(
                                                            property: "id",
                                                            type: "integer",
                                                            example: 1
                                                        ),
                                                        new OA\Property(
                                                            property: "code",
                                                            type: "string",
                                                            example: "internal"
                                                        ),
                                                        new OA\Property(
                                                            property: "name",
                                                            type: "string",
                                                            example: "Внутренний"
                                                        ),
                                                    ],
                                                ),
                                            ],
                                        ),
                                    ],
                                ),
                            ),
                            new OA\Property(
                                property: "resources",
                                type: "array",
                                description: "Ресурсы",
                                items: new OA\Items(
                                    type: "object",
                                    properties: [
                                        new OA\Property(
                                            property: "id",
                                            type: "integer",
                                            example: 19
                                        ),
                                        new OA\Property(
                                            property: "vika_type_id",
                                            type: "integer",
                                            example: 5
                                        ),
                                        new OA\Property(
                                            property: "resource_host",
                                            type: "string",
                                            example: "admhmansy.ru"
                                        ),
                                    ],
                                ),
                            ),
                        ],
                    ),
                ),
            ],
        );
    }
}

