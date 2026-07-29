<?php

namespace Modules\ActirovkiWidget\Swagger\Docs\Attributes\WeatherRangeController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class Store extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/actirovki/weather-ranges',
            operationId: 'storeWeatherRangeActirovkiWidget',
            summary: 'Добавить погодный диапазон для объявления актировки',
            requestBody: new OA\RequestBody(
                required: true,
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        properties: [
                            new OA\Property(
                                property: 'city_id',
                                description: 'ID населенного пункта',
                                type: 'integer',
                                format: 'int64',
                                example: 28,
                            ),
                            new OA\Property(
                                property: 'temperature',
                                description: 'Температура',
                                type: 'decimal',
                                example: -31,
                            ),
                            new OA\Property(
                                property: 'wind',
                                description: 'Скорость ветра',
                                type: 'integer',
                                example: 10,
                            ),
                            new OA\Property(
                                property: 'school_class',
                                description: 'Верхняя граница диапазона классов',
                                type: 'integer',
                                example: 11,
                            ),
                        ],
                    ),
                ),
            ),
            tags: ['ActirovkiWidgetPrivate'],
            responses: [
                new OA\Response(
                    response: 201,
                    description: 'Населенный пункт создан',
                    content: new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: 'data',
                                ref: '#/components/schemas/Weather',
                            ),
                        ],
                        type: 'object',
                    ),
                ),
                new OA\Response(response: 422, description: 'Ошибка валидации'),
                new OA\Response(response: 401, description: 'Ошибка аутентификации'),
            ],
        );
    }
}
