<?php

namespace Modules\ActirovkiWidget\Swagger\Docs\Attributes\CityController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class Update extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/actirovki/cities/{city}/update',
            operationId: 'updateCityActirovkiWidget',
            summary: 'Обновить населенный пункт',
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
                                example: '5a08166f-cfaa-4e95-8233-f0d473883bd3'
                            ),
                        ]
                    )
                )
            ),
            tags: ['ActirovkiWidgetPrivate'],
            parameters: [
                new OA\Parameter(
                    name: 'city',
                    description: 'ID населенного пункта',
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer')
                )
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Населенный пункт обновлен',
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
            ]
        );
    }
}
