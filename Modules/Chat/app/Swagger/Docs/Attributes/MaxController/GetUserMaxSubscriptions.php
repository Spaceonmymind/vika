<?php

namespace Modules\Chat\Swagger\Docs\Attributes\MaxController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetUserMaxSubscriptions extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/max/get_subscriptions",
            operationId: "getUserSubscriptions",
            summary: "Получить подписки пользователя на уведомления из MAX",
            tags: ["MaxController"],
            requestBody: new OA\RequestBody(
                description: "Параметры запроса",
                required: true,
                content: new OA\JsonContent(
                    type: "object",
                    required: ['web_app_data', 'hash'],
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
                            property: "event_type_id",
                            type: "integer",
                            nullable: true,
                            example: 2,
                            description: "Фильтр по типу события (актировки и т.п.)"
                        ),
                        new OA\Property(
                            property: "city_id",
                            type: "integer",
                            nullable: true,
                            example: 100,
                            description: "Город подписки для фильтрации"
                        ),
                    ]
                )
            ),
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Список подписок пользователя",
                    content: new OA\JsonContent(
                        type: "array",
                        items: new OA\Items(
                            properties: [
                                new OA\Property(
                                    property: "id",
                                    type: "integer",
                                    example: 12),
                                new OA\Property(
                                    property: "chat_id",
                                    type: "integer",
                                    nullable: true,
                                    example: null),
                                new OA\Property(
                                    property: "user_id",
                                    type: "integer",
                                    example: 50779503),
                                new OA\Property(
                                    property: "event_type_id",
                                    type: "integer",
                                    example: 2),
                                new OA\Property(
                                    property: "created_at",
                                    type: "string",
                                    format: "date-time",
                                    example: "2025-10-06T07:12:25.000000Z"),
                                new OA\Property(
                                    property: "updated_at",
                                    type: "string",
                                    format: "date-time",
                                    example: "2025-10-06T07:12:25.000000Z"),
                                new OA\Property(
                                    property: "deleted_at",
                                    type: "string",
                                    nullable: true,
                                    example: null),
                                new OA\Property(
                                    property: "weather_subscription_id",
                                    type: "integer",
                                    nullable: true,
                                    example: 6),
                                new OA\Property(
                                    property: "event_type",
                                    type: "object",
                                    properties: [
                                        new OA\Property(
                                            property: "id",
                                            type: "integer",
                                            example: 2),
                                        new OA\Property(
                                            property: "code",
                                            type: "string",
                                            example: "hospital_notifications"),
                                        new OA\Property(
                                            property: "description",
                                            type: "string",
                                            example: "Уведомления об действующих актировках"),
                                    ]
                                ),
                                new OA\Property(
                                    property: "weather_subscription",
                                    type: "object",
                                    properties: [
                                        new OA\Property(
                                            property: "id",
                                            type: "integer",
                                            example: 2),
                                        new OA\Property(
                                            property: "city_id",
                                            type: "integer",
                                            example: 28),
                                        new OA\Property(
                                            property: "school_class_range_id",
                                            type: "integer",
                                            example: 1),
                                        new OA\Property(
                                            property: "school_shift",
                                            type: "integer",
                                            example: 2),
                                        new OA\Property(
                                            property: "school_class_range",
                                            type: "object",
                                            properties: [
                                                new OA\Property(
                                                    property: "id",
                                                    type: "integer",
                                                    example: 1),
                                                new OA\Property(
                                                    property: "code",
                                                    type: "string",
                                                    example: 'from_1_to_4'),
                                                new OA\Property(
                                                    property: "name",
                                                    type: "string",
                                                    example: 'с 1 по 4 класс'),
                                                new OA\Property(
                                                    property: "description",
                                                    type: "string",
                                                    example: "Актировки для учеников с 1 по 4 класс"),
                                            ]
                                        ),
                                        new OA\Property(
                                            property: "city",
                                            type: "object",
                                            properties: [
                                                new OA\Property(
                                                    property: "id",
                                                    type: "integer",
                                                    example: 28),
                                                new OA\Property(
                                                    property: "fias_id",
                                                    type: "string",
                                                    example: '1f2e6d0b-008a-4ffc-a60d-e3b410a22762'),
                                                new OA\Property(
                                                    property: "name",
                                                    type: "string",
                                                    example: 'пгт. Андра'),
                                            ]
                                        ),
                                    ]
                                ),
                            ]
                        )
                    )
                )
            ]
        );
    }
}
