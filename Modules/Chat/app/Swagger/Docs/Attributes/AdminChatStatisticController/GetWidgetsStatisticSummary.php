<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminChatStatisticController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetWidgetsStatisticSummary extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/admin/chat/widgets/statistic/summary",
            operationId: "getWidgetsStatisticSummary",
            summary: "Получить статистику виджетов за указанный период",
            tags: ['AdminWidgetsStatistic'],
            parameters: [
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
                ),
                new OA\Parameter(
                    name: "from_telegram",
                    in: "query",
                    description: "Фильтр по сообщениям из Telegram (0 или 1)",
                    required: false,
                    schema: new OA\Schema(type: "integer")
                ),
                new OA\Parameter(
                    name: 'from_max',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'integer'),
                    description: 'Источник сообщения (0 - не из Max, 1 - из Max, null - все)',
                    example: 1
                ),
                new OA\Parameter(
                    name: "is_active_widget",
                    in: "query",
                    description: "Фильтр по активности виджетов (0 или 1)",
                    required: false,
                    schema: new OA\Schema(type: "integer")
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
                                new OA\Property(property: "widget_id", type: "integer", description: "ID виджета"),
                                new OA\Property(property: "call_count", type: "integer", description: "Количество вызовов виджета"),
                                new OA\Property(
                                    property: "widget",
                                    type: "object",
                                    description: "Данные виджета",
                                    properties: [
                                        new OA\Property(property: "id", type: "integer", description: "ID виджета"),
                                        new OA\Property(property: "code_name", type: "string", description: "Системное имя виджета"),
                                        new OA\Property(property: "name", type: "string", description: "Название виджета"),
                                        new OA\Property(property: "description", type: "string", description: "Описание виджета"),
                                        new OA\Property(property: "is_active", type: "boolean", description: "Статус активности виджета")
                                    ]
                                )
                            ]
                        )
                    )
                )
            ]
        );
    }
}
