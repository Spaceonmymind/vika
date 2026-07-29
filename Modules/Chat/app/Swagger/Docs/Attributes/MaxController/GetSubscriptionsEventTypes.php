<?php

namespace Modules\Chat\Swagger\Docs\Attributes\MaxController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetSubscriptionsEventTypes extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/max/get_subscription_event_types",
            operationId: "getSubscriptionEventTypes",
            summary: "Получение всех типов событий, на которые можно подписаться в Max",
            tags: ["MaxController"],
            parameters: [
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Список подписок пользователя",
                    content: new OA\JsonContent(
                        type: "array",
                        items: new OA\Items(
                            properties: [
                                new OA\Property(property: "id", type: "integer", example: 1),
                                new OA\Property(property: "code", type: "string", example: "actirovki"),
                                new OA\Property(property: "description", type: "string", example: "Уведомления об действующих актировках"),
                            ]
                        )
                    )
                )
            ]
        );
    }
}
