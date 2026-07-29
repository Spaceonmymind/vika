<?php

namespace Modules\ActirovkiWidget\Swagger\Docs\Attributes\CityController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class Store extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/actirovki/cities',
            operationId: 'storeCityActirovkiWidget',
            summary: 'Создать новый населенный пункт',
            requestBody: new OA\RequestBody(
                required: true,
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        properties: [
                            new OA\Property(
                                property: 'name',
                                description: 'Название населенного пункта',
                                type: 'string',
                                example: 'г. Омск'
                            ),
                            new OA\Property(
                                property: 'fias_id',
                                description: 'ФИАС ID',
                                type: 'string',
                                example: '140e31da-27bf-4519-9ea0-6185d681d44e'
                            ),
                            new OA\Property(
                                property: 'reference_city_id',
                                description: 'ID населенного пункта, для клонирования правил по актировкам',
                                type: 'integer',
                                example: '28'
                            ),
                        ]
                    )
                )
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
                                ref: '#/components/schemas/City'
                            )
                        ],
                        type: 'object'
                    )
                ),
                new OA\Response(response: 422, description: 'Ошибка валидации'),
                new OA\Response(response: 401, description: 'Ошибка аутентификации'),
                new OA\Response(response: 500, description: 'Не удалось создать город'),
            ]
        );
    }
}
