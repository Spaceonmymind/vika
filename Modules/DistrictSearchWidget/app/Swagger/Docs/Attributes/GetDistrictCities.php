<?php

namespace Modules\DistrictSearchWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetDistrictCities extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/district_search/get_cities",
            operationId: "getDistrictCities",
            summary: "Возвращает список населенных пунктов",
            tags: ['DistrictSearchWidget'],
            parameters: [
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Successful operation",
                    content: new OA\JsonContent(
                        type: "array",
                        items: new OA\Items(
                            properties: [
                                new OA\Property(
                                    property: "id",
                                    type: "integer",
                                    example: 922,
                                ),
                                new OA\Property(
                                    property: "name",
                                    type: "string",
                                    description: "Наименование населенного пункта",
                                    example: 'Барсово',
                                ),
                            ],
                        ),
                    ),
                ),
            ],
        );
    }
}
