<?php

namespace Modules\SportSectionsWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetCities extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/sport_sections/get_cities',
            operationId: 'getSportSectionsCities',
            summary: 'Получить список городов',
            tags: ['SportSectionsWidget'],
            parameters: [
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Successful operation',
                    content: new OA\JsonContent(
                        type: 'array',
                        items: new OA\Items(
                            type: 'object',
                            properties: [
                                new OA\Property(
                                    property: 'id',
                                    description: 'Идентификатор города',
                                    type: 'integer',
                                    example: 92,
                                ),
                                new OA\Property(
                                    property: 'name',
                                    description: 'Название города',
                                    type: 'string',
                                    example: 'г.Нефтеюганск',
                                ),
                            ]
                        )
                    )
                )
            ]
        );
    }
}
