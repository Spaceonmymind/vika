<?php

namespace Modules\ActirovkiWidget\Swagger\Docs\Attributes\StatisticController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class AllToday extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/actirovki/statistic/all-today',
            operationId: 'allTodayStatisticActirovkiWidget',
            summary: 'Статистика по актировкам сегодня',
            tags: ['ActirovkiWidgetPrivate'],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Успешный ответ',
                    content: new OA\JsonContent(
                        type: "object",
                        example: [
                            "data" => [
                                "shifts" => [
                                    1 => [
                                        4 => 22,
                                        8 => 21,
                                        11 => 15
                                    ],
                                    2 => [
                                        4 => 20,
                                        8 => 11,
                                        11 => 9
                                    ]
                                ]
                            ]
                        ]
                    ),
                ),
            ],
        );
    }
}
