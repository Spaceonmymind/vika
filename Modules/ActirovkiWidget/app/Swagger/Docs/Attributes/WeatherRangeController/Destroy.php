<?php

namespace Modules\ActirovkiWidget\Swagger\Docs\Attributes\WeatherRangeController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class Destroy extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/actirovki/weather-ranges/{weather}/delete',
            operationId: 'destroyWeatherRangeActirovkiWidget',
            summary: 'Удалить погодный диапазон',
            tags: ['ActirovkiWidgetPrivate'],
            parameters: [
                new OA\Parameter(
                    name: 'weather',
                    description: 'ID погодного диапазона',
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer')
                )
            ],
            responses: [
                new OA\Response(response: 204, description: 'Успешное удаление'),
                new OA\Response(response: 404, description: 'Населенный пункт не найден'),
                new OA\Response(response: 401, description: 'Ошибка аутентификации'),
            ]
        );
    }
}
