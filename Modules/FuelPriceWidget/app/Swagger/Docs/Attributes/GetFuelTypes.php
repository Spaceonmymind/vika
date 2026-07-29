<?php

namespace Modules\FuelPriceWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetFuelTypes extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/fuel_price/get_fuel_types',
            operationId: 'getFuelTypes',
            summary: 'Получить список видов топлива',
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
                                    description: 'Идентификатор вида топлива',
                                    type: 'integer'
                                ),
                                new OA\Property(
                                    property: 'name',
                                    description: 'Название вида топлива',
                                    type: 'string'
                                ),
                                new OA\Property(
                                    property: 'code',
                                    description: 'Код вида топлива',
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
