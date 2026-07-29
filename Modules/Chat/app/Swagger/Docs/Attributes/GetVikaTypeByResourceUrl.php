<?php

namespace Modules\Chat\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetVikaTypeByResourceUrl extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/chat/get_vika_type_by_resource",
            operationId: "getVikaTypeByResourceUrl",
            tags: ["Chat"],
            summary: "Получить тип Вики по ссылке ресурса",
            parameters: [
                new OA\Parameter(
                    name: "resource_url",
                    in: "query",
                    required: true,
                    description: "URL ресурса, для которого нужно определить тип Вики, не нужно его обрезать и т.д. я все сам сделаю",
                    schema: new OA\Schema(
                        type: "string",
                        format: "url",
                        example: "https://AdmahmansYdDdd.ru/basfbjnk/asfnj?aaa=bbb"
                    )
                )
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Информация о типе Вики",
                    content: new OA\JsonContent(
                        type: "object",
                        properties: [
                            new OA\Property(
                                property: "id",
                                type: "integer",
                                description: "ID типа Вики",
                                example: 1
                            ),
                            new OA\Property(
                                property: "name",
                                type: "string",
                                description: "Название типа Вики",
                                example: "main"
                            ),
                            new OA\Property(
                                property: "description",
                                type: "string",
                                nullable: true,
                                description: "Описание типа Вики",
                                example: "Основной тип Вики"
                            )
                        ]
                    )
                )
            ]
        );
    }
}
