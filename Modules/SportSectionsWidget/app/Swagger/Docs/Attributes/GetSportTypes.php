<?php

namespace Modules\SportSectionsWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetSportTypes extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/sport_sections/get_sport_types',
            operationId: 'getSportTypes',
            summary: 'Получить список видов спорта',
            tags: ['SportSectionsWidget'],
            parameters: [
                new OA\Parameter(
                    name: 'city_id',
                    in: 'query',
                    required: false,
                    description: 'Идентификатор города',
                    example: 4,
                    schema: new OA\Schema(
                        type: 'integer',
                    ),
                )
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
                                    description: 'Идентификатор вида спорта',
                                    type: 'integer',
                                    example: 4,
                                ),
                                new OA\Property(
                                    property: 'name',
                                    description: 'Название вида спорта',
                                    type: 'string',
                                    example: 'Волейбол',
                                ),
                            ]
                        )
                    )
                )
            ]
        );
    }
}
