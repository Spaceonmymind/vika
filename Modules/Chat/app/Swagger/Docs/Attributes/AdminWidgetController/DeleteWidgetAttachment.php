<?php
namespace Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class DeleteWidgetAttachment extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/admin/chat/widgets/attaching/{attaching_id}/delete",
            operationId: "deleteWidgetAttachment",
            summary: "Удалить привязку виджета к типу Вики и категории",
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
