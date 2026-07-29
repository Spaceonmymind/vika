<?php

namespace Modules\ActirovkiWidget\Swagger\Docs\Attributes\WeatherController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class Destroy extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/actirovki/weathers/{weather}/delete',
            operationId: 'destroyWeatherActirovkiWidget',
            summary: 'Удалить данные о погоде',
            tags: ['ActirovkiWidgetPrivate'],
            parameters: [
                new OA\Parameter(
                    name: 'weather',
                    description: 'ID данных о погоде',
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
