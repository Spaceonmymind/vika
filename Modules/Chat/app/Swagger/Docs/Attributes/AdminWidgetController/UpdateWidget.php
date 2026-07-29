<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class UpdateWidget extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/admin/chat/widgets/{widget_id}/update",
            operationId: "updateWidget",
            summary: "Обновить виджет",
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
            requestBody: new OA\RequestBody(
                required: true,
                content: new OA\MediaType(
                    mediaType: "application/json",
                    schema: new OA\Schema(
                        required: ["code_name", "name", "is_active"],
                        properties: [
                            new OA\Property(
                                property: "code_name",
                                type: "string",
                                description: "Кодовое имя виджета",
                                example: "vi-test22"
                            ),
                            new OA\Property(
                                property: "name",
                                type: "string",
                                description: "Название виджета",
                                example: "Тестовый виджет2"
                            ),
                            new OA\Property(
                                property: "description",
                                type: "string",
                                nullable: true,
                                description: "Описание виджета",
                                example: "Описание тестового виджета2"
                            ),
                            new OA\Property(
                                property: "icon_id",
                                type: "integer",
                                nullable: true,
                                description: "ID иконки",
                                example: 2
                            ),
                            new OA\Property(
                                property: "url",
                                type: "string",
                                nullable: true,
                                description: "URL виджета",
                                example: "https://www.google.com/search?q=laravel+get+hostname+from+url2"
                            ),
                            new OA\Property(
                                property: "bg_colour",
                                type: "string",
                                nullable: true,
                                description: "Цвет фона виджета",
                                example: "#123457"
                            ),
                            new OA\Property(
                                property: "is_active",
                                type: "boolean",
                                description: "Активен ли виджет",
                                example: true
                            )
                        ]
                    )
                )
            ),
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Успешная операция",
                    content: new OA\JsonContent(
                        type: "object",
                        properties: [
                            new OA\Property(
                                property: "success",
                                type: "boolean",
                                description: "Успешность выполнения операции",
                                example: true
                            )
                        ]
                    )
                )
            ]
        );
    }
}
