<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminVikaTypeController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class CreateVikaType extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/admin/chat/vika_types/create",
            operationId: "createVikaType",
            summary: "Создать новый тип Вики",
            tags: ["AdminVikaTypeController"],
            requestBody: new OA\RequestBody(
                required: true,
                content: new OA\MediaType(
                    mediaType: "application/json",
                    schema: new OA\Schema(
                        required: ["name", "description"],
                        properties: [
                            new OA\Property(
                                property: "name",
                                type: "string",
                                description: "Код типа Вики",
                                example: "test"
                            ),
                            new OA\Property(
                                property: "description",
                                type: "string",
                                description: "Русское название типа вики",
                                example: "Тестовый тип Вики"
                            ),
                            new OA\Property(
                                property: "resources",
                                type: "array",
                                description: "Список ресурсов, где будет доступен данный тип Вики",
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
                        ],
                        example: [
                            "success" => true
                        ]
                    )
                )
            ]
        );
    }
}
