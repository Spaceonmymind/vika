<?php

namespace Modules\Chat\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetChatHints extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/chat/get_chat_hints",
            operationId: "getChatHints",
            summary: "Возвращает список подсказок для чата, для заданного типа Вики",
            tags: ['Chat'],
            parameters: [
                new OA\Parameter(
                    name: "vika_type",
                    in: "query",
                    required: false,
                    description: "Тип вики",
                    example: 'main',
                    schema: new OA\Schema(
                        type: "string",
                    ),
                ),
                new OA\Parameter(
                    name: "query",
                    in: "query",
                    required: false,
                    description: "Строка поиска",
                    example: 'рождение',
                    schema: new OA\Schema(
                        type: "string",
                    ),
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Successful operation",
                    content: new OA\JsonContent(
                        type: "array",
                        items: new OA\Items(
                            properties: [
                                new OA\Property(
                                    property: "id",
                                    type: "integer",
                                    example: 29,
                                ),
                                new OA\Property(
                                    property: "value",
                                    type: "string",
                                    description: "Значение подсказки",
                                    example: 'рождение ребёнка',
                                ),
                            ],
                        ),
                    ),
                ),
            ],
        );
    }
}
