<?php

namespace Modules\Chat\Swagger\Docs\Attributes\MaxController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetSubscriptionSchoolClassRanges extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/max/get_subscription_weather_school_class_ranges",
            operationId: "getSubscriptionSchoolClassRanges",
            summary: "Получение всех диапазонов классов школы для подписки на погоду в Max",
            tags: ["MaxController"],
            parameters: [
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Список диапазонов",
                    content: new OA\JsonContent(
                        type: "array",
                        items: new OA\Items(
                            properties: [
                                new OA\Property(property: "id", type: "integer", example: 1),
                                new OA\Property(property: "code", type: "string", example: "from_1_to_4"),
                                new OA\Property(property: "name", type: "string", example: "с 1 по 4 класс"),
                                new OA\Property(property: "description", type: "string", example: "Актировки для учеников с 1 по 4 класс"),
                            ]
                        )
                    )
                )
            ]
        );
    }
}
