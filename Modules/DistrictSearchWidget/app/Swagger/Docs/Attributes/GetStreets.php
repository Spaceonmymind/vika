<?php

namespace Modules\DistrictSearchWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetStreets extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/district_search/get_streets",
            operationId: "getStreets",
            summary: 'Возвращает список улиц в населённом пункте. Возвращаются только улицы для которых есть участки.',
            tags: ['DistrictSearchWidget'],
            parameters: [
                new OA\Parameter(
                    name: 'city_id',
                    in: 'query',
                    required: true,
                    description: 'Идентификатор населённого пункта',
                    schema: new OA\Schema(
                        type: 'integer'
                    )
                ),
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
                                    example: 43929,
                                ),
                                new OA\Property(
                                    property: "name",
                                    type: "string",
                                    description: "Наименование улицы",
                                    example: 'переулок Никифорова',
                                ),
                            ],
                        ),
                    ),
                ),
            ],
        );
    }
}
