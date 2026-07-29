<?php

namespace Modules\Chat\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetChatMessages extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/chat/get_history',
            operationId: 'getHistory',
            summary: 'Получить историю чата, если история пустая, то запускает приветственное сообщение в сокет с задержкой в секунду',
            tags: ['Chat'],
            parameters: [
                new OA\Parameter(
                    name: 'chat_id',
                    description: 'Уникальный идентификатор чата. Если не передан, то сгенерируется автоматически',
                    required: false,
                    in: 'cookie',
                    schema: new OA\Schema(
                        type: "string",
                    ),
                ),
                new OA\Parameter(
                    name: 'vika_type',
                    description: 'Тип вики, необходим для отпавки приветственного сообщения',
                    required: false,
                    schema: new OA\Schema(
                        type: "string"
                    ),
                    in: 'query',
                    example: 'main'
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Successful operation',
                    content: new OA\JsonContent(
                        type: 'object',
                        allOf: [
                            new OA\Property(ref: '#/components/schemas/SimplePaginator'),
                            new OA\Schema(
                                properties: [
                                    new OA\Property(
                                        property: 'data',
                                        description: 'Список сообщений чата',
                                        type: 'array',
                                        items: new OA\Items(ref: '#/components/schemas/ChatMessage'),
                                    )
                                ]
                            )
                        ]
                    )
                )
            ]
        );
    }
}
