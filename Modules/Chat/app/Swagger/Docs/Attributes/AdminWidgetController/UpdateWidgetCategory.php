<?php
namespace Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class UpdateWidgetCategory extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/admin/chat/widgets/categories/{category}/update",
            operationId: "updateWidgetCategory",
            summary: "Обновить категорию виджетов",
            tags: ["AdminWidgetController",'AdminVikaTypeController'],
            parameters: [
                new OA\Parameter(
                    name: "category",
                    in: "path",
                    required: true,
                    schema: new OA\Schema(type: "integer"),
                    description: "ID категории виджетов"
                )
            ],
            requestBody: new OA\RequestBody(
                required: true,
                content: new OA\MediaType(
                    mediaType: "application/json",
                    schema: new OA\Schema(
                        required: ["name"],
                        properties: [
                            new OA\Property(
                                property: "name",
                                type: "string",
                                description: "Название категории",
                                example: "Обновленная категория"
                            ),
                            new OA\Property(
                                property: "description",
                                type: "string",
                                nullable: true,
                                description: "Описание категории",
                                example: "Обновленное описание категории"
                            ),
                            new OA\Property(
                                property: "icon_id",
                                type: "integer",
                                nullable: true,
                                description: "ID иконки",
                                example: 2
                            ),
                            new OA\Property(
                                property: "order",
                                type: "integer",
                                nullable: true,
                                description: "Порядок отображения категории",
                                example: 100
                            ),
                            new OA\Property(
                                property: "bg_colour",
                                type: "string",
                                nullable: true,
                                description: "Цвет фона иконки категории",
                                example: "#FFFFFF"
                            ),
                            new OA\Property(
                                property: "is_favorite",
                                type: "boolean",
                                nullable: false,
                                description: "Отображать ли категорию в избранном(панели быстрого доступа)",
                                example: true,
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
