<?php

namespace Modules\ActirovkiWidget\Swagger\Docs\Attributes\WeatherRangeController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class Index extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/actirovki/weather-ranges',
            operationId: 'indexWeatherRangeActirovkiWidget',
            summary: 'Получить правила объявления актировки для всех населенных пунктов',
            tags: ['ActirovkiWidgetPublic'],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Успешный ответ',
                    content: new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: 'data',
                                description: 'Правила объявления актировки',
                                type: 'array',
                                items: new OA\Items(
                                    ref: '#/components/schemas/WeatherRange'
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
