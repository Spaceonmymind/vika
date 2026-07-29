<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminVikaTypeController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class UpdateVikaType extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/admin/chat/vika_types/{vika_type}/update",
            operationId: "updateVikaType",
            summary: "Обновить тип Вики",
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
            requestBody: new OA\RequestBody(
                required: true,
                content: new OA\MediaType(
                    mediaType: "application/json",
                    schema: new OA\Schema(
                        required: ["name", "description"],
                        properties: [
                            new OA\Property(
                                property: "description",
                                type: "string",
                                description: "Описание типа Вики",
                                example: "Описание для типа Вики 1"
                            ),
                            new OA\Property(
                                property: "resources",
                                type: "array",
                                description: "Список ресурсов",
                                items: new OA\Items(
                                    type: "string",
                                    format: "url",
                                    example: "https://admhmansy.ru"
                                )
                            )
                        ],
                        example: [
                            "name" => "test",
                            "description" => "Тестовый тип Вики",
                            "resources" => [
                                "https://admhmansy.ru"
                            ]
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
