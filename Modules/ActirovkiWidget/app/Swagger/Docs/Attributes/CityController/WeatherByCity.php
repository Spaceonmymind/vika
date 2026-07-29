<?php

namespace Modules\ActirovkiWidget\Swagger\Docs\Attributes\CityController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class WeatherByCity extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/actirovki/cities/{city}/weathers',
            operationId: 'indexByCityWeatherActirovkiWidget',
            summary: 'Получить историю данных о погоде в населенном пункте',
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
                                    ref: '#/components/schemas/Weather'
                                )
                            ),
                        ],
                        type: "object"
                    ),
                ),
            ],
        );
    }
}
