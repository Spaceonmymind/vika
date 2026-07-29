<?php

namespace Modules\Chat\Swagger\Docs\Attributes\MaxController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class DeleteMaxSubscription extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/max/unsubscribe",
            operationId: "deleteSubscription",
            summary: "Удалить подписку на уведомления из MAX",
            tags: ["MaxController"],

            requestBody: new OA\RequestBody(
                description: "Парамеры запроса",
                required: true,
                content: new OA\JsonContent(
                    type: "object",
                    required: ['web_app_data', 'hash', 'subscription_id'],
                    properties: [
                        new OA\Property(
                            property: 'web_app_data',
                            type: 'string',
                            description: 'Подготовленные данные, полученные из web app',
                            example: "auth_date=1758887097\nquery_id=..."
                        ),
                        new OA\Property(
                            property: 'hash',
                            type: 'string',
                            description: 'Хеш для проверки подлинности данных',
                            example: '99da5bacf025884dfea08f85886fc1ce7aea469cad255bd24fe3a1ae5cfc7f99'
                        ),
                        new OA\Property(
                            property: "subscription_id",
                            type: "integer",
                            example: 10,
                            description: "ID подписки, которую нужно удалить"
                        ),
                    ]
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
                            ),
                        ]
                    )
                )
            ]
        );
    }
}
