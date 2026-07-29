<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminVikaTypeController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class DeleteVikaType extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/admin/chat/vika_types/{vika_type}/delete",
            operationId: "deleteVikaType",
            summary: "Удалить тип Вики",
            tags: ["AdminVikaTypeController"],
            parameters: [
                new OA\Parameter(
                    name: "vika_type",
                    in: "path",
                    required: true,
                    schema: new OA\Schema(type: "integer"),
                    description: "ID типа Вики"
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
