<?php
namespace Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class UpdateWidgetAttachment extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/admin/chat/widgets/attaching/{attaching_id}/update",
            operationId: "updateWidgetAttachment",
            summary: "Обновить привязку виджета к типу Вики и категории",
            tags: ["AdminWidgetController",'AdminVikaTypeController'],
            parameters: [
                new OA\Parameter(
                    name: "attaching_id",
                    in: "path",
                    required: true,
                    schema: new OA\Schema(type: "integer"),
                    description: "ID привязки виджета"
                )
            ],
            requestBody: new OA\RequestBody(
                required: true,
                content: new OA\MediaType(
                    mediaType: "application/json",
                    schema: new OA\Schema(
                        required: ["order"],
                        properties: [
                            new OA\Property(
                                property: "category_id",
                                type: "integer",
                                nullable: true,
                                description: "ID категории виджетов",
                                example: 3
                            ),
                            new OA\Property(
                                property: "order",
                                type: "integer",
                                description: "Порядок отображения",
                                example: 110
                            ),
                            new OA\Property(
                                property: "is_favorite",
                                type: "boolean",
                                nullable: false,
                                description: "Отображать ли виджет в избранном(панели быстрого доступа)",
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
