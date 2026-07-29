<?php

namespace Modules\Chat\Swagger\Docs\Attributes\MaxController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class CreateMaxSubscription extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/max/subscribe",
            operationId: "createSubscription",
            summary: "Подписаться на уведомления из MAX",
            tags: ["MaxController"],
            requestBody: new OA\RequestBody(
                description: "Параметры запроса",
                required: true,
                content: new OA\JsonContent(
                    type: "object",
                    required: ['web_app_data', 'hash', 'event_type_id'],
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
                            example: 2,
                            description: "ID типа события (запись на приём к врачу, актировки)"
                        ),
                        new OA\Property(
                            property: "city_id",
                            type: "integer",
                            nullable: false,
                            example: 28,
                            description: "ID города (из таблицы actirovki_widget_cities"
                        ),
                        new OA\Property(
                            property: "school_class_range_id",
                            type: "integer",
                            nullable: false,
                            example: 3,
                            description: "ID диапазона классов школы"
                        ),
                        new OA\Property(
                            property: "school_shift",
                            type: "integer",
                            nullable: false,
                            example: 1,
                            description: "Смена в школе (1 - первая, 2 - вторая)"
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
                ),
                new OA\Response(
                    response: 422,
                    description: "Некорректный запрос",
                    content: new OA\JsonContent(
                        type: "object",
                        properties: [
                            new OA\Property(
                                property: "message",
                                type: "string",
                                example: "Значение поля event type id не существует."
                            ),
                            new OA\Property(
                                property: "errors",
                                type: "object",
                                properties: [
                                    new OA\Property(
                                        property: "event_type_id",
                                        type: "array",
                                        items: new OA\Items(
                                            type: "string",
                                            example: "Значение поля event type id не существует."
                                        )
                                    ),
                                ]
                            ),
                        ]
                    )
                ),
            ]
        );
    }
}
