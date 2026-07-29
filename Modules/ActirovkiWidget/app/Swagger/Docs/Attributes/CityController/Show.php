<?php

namespace Modules\ActirovkiWidget\Swagger\Docs\Attributes\CityController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class Show extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/actirovki/cities/{city}',
            operationId: 'showCityActirovkiWidget',
            summary: 'Получить информацию о населенном пункте',
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
                                ref: '#/components/schemas/City'
                            )
                        ],
                        type: 'object'
                    )
                ),
                new OA\Response(response: 404, description: 'Населенный пункт не найден')
            ],
        );
    }
}
