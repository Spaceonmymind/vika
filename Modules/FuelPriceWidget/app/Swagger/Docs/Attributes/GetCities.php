<?php

namespace Modules\FuelPriceWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetCities  extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/fuel_price/get_cities',
            operationId: 'getCities',
            summary: 'Получить список городов',
            tags: ['FuelPriceWidget'],
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
                                    type: 'integer'
                                ),
                                new OA\Property(
                                    property: 'name',
                                    description: 'Название города',
                                    type: 'string'
                                )
                            ]
                        )
                    )
                )
            ]
        );
    }
}
