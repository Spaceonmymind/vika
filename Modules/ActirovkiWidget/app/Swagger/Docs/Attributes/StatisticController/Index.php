<?php

namespace Modules\ActirovkiWidget\Swagger\Docs\Attributes\StatisticController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class Index extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/actirovki/statistic',
            operationId: 'indexStatisticActirovkiWidget',
            summary: 'Статистика по актировкам за выбранный период с разбивкой по городам',
            tags: ['ActirovkiWidgetPrivate'],
            parameters: [
                new OA\Parameter(
                    name: 'filter[city_id]',
                    description: 'ID населенного пункта',
                    in: 'query',
                    schema: new OA\Schema(type: 'integer'),
                    example: 28
                ),
                new OA\Parameter(
                    name: 'filter[date_from]',
                    description: 'Дата начала диапазона',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'string', format: 'date', example: '01.01.2025'),
                ),
                new OA\Parameter(
                    name: 'filter[date_to]',
                    description: 'Дата окончания диапазона',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'string', format: 'date', example: '30.04.2025'),
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Успешный ответ',
                    content: new OA\JsonContent(
                        type: "object",
                        example: [
                            "data" => [
                                [
                                    "city" => "пгт. Андра",
                                    "shifts" => [
                                        1 => [
                                            4 => 168,
                                            8 => 187,
                                            11 => 154
                                        ],
                                        2 => [
                                            4 => 157,
                                            8 => 158,
                                            11 => 166
                                        ]
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
