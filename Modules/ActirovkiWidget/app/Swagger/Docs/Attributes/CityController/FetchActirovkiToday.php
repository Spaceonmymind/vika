<?php

namespace Modules\ActirovkiWidget\Swagger\Docs\Attributes\CityController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class FetchActirovkiToday extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/actirovki/cities/{city}/actirovki/today',
            operationId: 'fetchActirovkiTodayActirovkiWidget',
            summary: 'Получить актировки за текущую дату',
            tags: ['ActirovkiWidgetPublic'],
            parameters: [
                new OA\Parameter(
                    name: 'city',
                    description: 'ID населенного пункта',
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer'),
                    example: 28
                )
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Успешный ответ',
                    content: new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: 'data',
                                description: 'Данные о погоде в населенном пункте',
                                type: 'array',
                                items: new OA\Items(
                                    ref: '#/components/schemas/Actirovki'
                                )
                            ),
                        ],
                        type: "object",
                        example: [
                            'data' => [
                                [
                                    'school_shift' => '1',
                                    'status' => 'announced',
                                    'message' => '15.05.2025 занятия 1-й смены с 1 по 4 класс отменяются.',
                                    'row' => [
                                        'id' => 1,
                                        'city_id' => 28,
                                        'weather_id' => 1,
                                        'weather_range_id' => 1,
                                        'school_shift' => 1,
                                        'weather' => [
                                            'id' => 1,
                                            'city_id' => 28,
                                            'temperature' => -40,
                                            'wind' => 10,
                                            'created_at' => '2025-05-15T11:16:19.000000Z',
                                        ],
                                        'weather_range' => [
                                            'id' => 1,
                                            'city_id' => 28,
                                            'temperature' => -29,
                                            'wind' => 0,
                                            'school_class' => 4,
                                        ],
                                    ],
                                ],
                                [
                                    'school_shift' => '2',
                                    'status' => 'not_announced',
                                    'message' => '15.05.2025 на 11:30 температурные условия не превышают пороговых для объявления актировки 2-й смены.',
                                    'row' => null,
                                ],
                            ],
                        ]
                    ),
                ),
            ],
        );
    }
}
