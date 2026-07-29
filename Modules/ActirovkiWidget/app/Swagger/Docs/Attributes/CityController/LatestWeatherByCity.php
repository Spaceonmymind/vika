<?php

namespace Modules\ActirovkiWidget\Swagger\Docs\Attributes\CityController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class LatestWeatherByCity extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/actirovki/cities/{city}/latest-weather',
            operationId: 'latestWeatherByCityWeatherActirovkiWidget',
            summary: 'Погода для населенного пункта за сегодня',
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
                                ref: '#/components/schemas/Weather',
                                description: 'Данные о погоде в населенном пункте'
                            ),
                        ],
                        type: "object"
                    ),
                ),
                new OA\Response(response: 404, description: 'Погодные данные за сегодня отсутствуют'),
            ],
        );
    }
}
