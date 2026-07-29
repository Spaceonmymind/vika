<?php
namespace Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class CreateWidgetAttachment extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/admin/chat/widgets/attaching/create",
            operationId: "addWidgetToVikaType",
            summary: "Привязать виджет к типу Вики и категории",
            tags: ["AdminWidgetController","AdminVikaTypeController"],
            requestBody: new OA\RequestBody(
                required: true,
                content: new OA\MediaType(
                    mediaType: "application/json",
                    schema: new OA\Schema(
                        required: ["chat_widget_id", "vika_type_id"],
                        properties: [
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
                                description: "ID категории виджетов",
                                example: 3
                            ),
                            new OA\Property(
                                property: "order",
                                type: "integer",
                                description: "Порядок отображения",
                                example: 1
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
