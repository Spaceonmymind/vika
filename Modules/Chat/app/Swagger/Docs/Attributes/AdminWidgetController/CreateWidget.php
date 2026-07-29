<?php
namespace Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class CreateWidget extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/admin/chat/widgets/create",
            operationId: "createWidget",
            summary: "Создать новый ссылочный виджет",
            tags: ["AdminWidgetController"],
            requestBody: new OA\RequestBody(
                required: true,
                content: new OA\MediaType(
                    mediaType: "application/json",
                    schema: new OA\Schema(
                        required: ["code_name", "name", "is_active","url"],
                        properties: [
                            new OA\Property(
                                property: "code_name",
                                type: "string",
                                description: "Кодовое имя виджета",
                                example: "vi-test"
                            ),
                            new OA\Property(
                                property: "name",
                                type: "string",
                                description: "Название виджета",
                                example: "Тестовый виджет"
                            ),
                            new OA\Property(
                                property: "description",
                                type: "string",
                                nullable: true,
                                description: "Описание виджета",
                                example: "Описание тестового виджета"
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
                                description: "URL виджета",
                                example: "https://www.google.com/search?q=laravel+get+hostname+from+url"
                            ),
                            new OA\Property(
                                property: "bg_colour",
                                type: "string",
                                nullable: true,
                                description: "Цвет фона виджета",
                                example: "#123456"
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
