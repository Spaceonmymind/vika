<?php

namespace Modules\Chat\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class CreateWidgetUsageRecord extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/chat/safe_widget_hit",
            operationId: "createWidgetUsageRecord",
            summary: "Сохранить использование виджета",
            tags: ['Chat'],
            requestBody: new OA\RequestBody(
                description: 'Input data',
                required: true,
                content: [
                    new OA\MediaType(
                        mediaType: 'application/json',
                        schema: new OA\Schema(
                            required: ['chat_id', 'widget_code_name'],
                            type: 'object',
                            properties: [
                                new OA\Property(
                                    property: 'chat_id',
                                    description: 'Идентификатор чата, от куда был вызван виджет',
                                    type: 'string',
                                    example: 'a0667d5a-03c1-40c4-9472-afbe5caa51b3',
                                ),
                                new OA\Property(
                                    property: 'widget_code_name',
                                    description: 'Код виджета',
                                    type: 'string',
                                    example: 'vi-business-help',
                                ),
                                new OA\Property(
                                    property: 'from_tg',
                                    description: 'Был ли вызван виджет из телеги',
                                    type: 'boolean',
                                    example: false,
                                    default: false,
                                ),
                                new OA\Property(
                                    property: 'from_max',
                                    description: 'Был ли вызван виджет из Макса',
                                    type: 'boolean',
                                    example: false,
                                    default: false,
                                ),
                            ],
                        ),
                    ),
                ],
            ),
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
                                description: "Статус успешной отправки сообщения",
                                example: true
                            ),
                        ],
                    ),
                ),
            ],
        );
    }
}
