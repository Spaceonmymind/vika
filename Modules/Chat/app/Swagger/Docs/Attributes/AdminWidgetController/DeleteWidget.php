<?php
namespace Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class DeleteWidget extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/admin/chat/widgets/{widget_id}/delete",
            operationId: "deleteWidget",
            summary: "Удалить виджет",
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
