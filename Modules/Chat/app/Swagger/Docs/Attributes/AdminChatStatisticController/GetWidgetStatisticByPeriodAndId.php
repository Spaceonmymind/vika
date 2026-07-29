<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminChatStatisticController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetWidgetStatisticByPeriodAndId extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/admin/chat/widgets/statistic/{widget}",
            operationId: "getWidgetStatisticByPeriodAndId",
            summary: "Получить статистику вызовов виджета за указанный период по дням",
            tags: ['AdminWidgetsStatistic'],
            parameters: [
                new OA\Parameter(
                    name: "widget",
                    in: "path",
                    description: "ID виджета",
                    required: true,
                    schema: new OA\Schema(type: "integer")
                ),
                new OA\Parameter(
                    name: "from",
                    in: "query",
                    description: "Дата начала периода (любой формат даты, будет преобразована в начало дня)",
                    required: true,
                    example: '15.05.2025',
                    schema: new OA\Schema(type: "string", format: "date")
                ),
                new OA\Parameter(
                    name: "to",
                    in: "query",
                    description: "Дата окончания периода (любой формат даты, будет преобразована в конец дня)",
                    required: true,
                    example: '25.05.2025',
                    schema: new OA\Schema(type: "string", format: "date")
                )
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Успешная операция",
                    content: new OA\JsonContent(
                        type: "array",
                        items: new OA\Items(
                            type: "object",
                            properties: [
                                new OA\Property(
                                    property: "date",
                                    type: "string",
                                    format: "date",
                                    description: "Дата вызова",
                                    example: "2025-05-19"
                                ),
                                new OA\Property(
                                    property: "call_count",
                                    type: "integer",
                                    description: "Количество вызовов за день",
                                    example: 2
                                )
                            ]
                        )
                    )
                )
            ]
        );
    }
}
