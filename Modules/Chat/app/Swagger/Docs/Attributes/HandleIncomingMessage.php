<?php

namespace Modules\Chat\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class HandleIncomingMessage  extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/chat/send_message",
            operationId: "handleIncomingMessage",
            summary: "Отправить сообщение",
            tags: ['Chat'],
            parameters: [
                new OA\Parameter(
                    name: "message",
                    in: "query",
                    description: "Текст сообщения",
                    required: true,
                    schema: new OA\Schema(type: "string")
                ),
                new OA\Parameter(
                    name: "vika_type",
                    in: "query",
                    description: "Тип Вики",
                    required: true,
                    schema: new OA\Schema(type: "string")
                )
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Successful operation",
                    content: new OA\JsonContent(
                        type: "object",
                        properties: [
                            new OA\Property(
                                property: "success",
                                type: "boolean",
                                description: "Статус успешной отправки сообщения"
                            ),
                            new OA\Property(
                                property: "message_id",
                                type: "integer",
                                description: "Идентификатор созданного сообщения"
                            )
                        ]
                    )
                )
            ]
        );
    }
}
