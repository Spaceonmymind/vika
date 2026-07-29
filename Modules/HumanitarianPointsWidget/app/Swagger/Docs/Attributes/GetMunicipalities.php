<?php

namespace Modules\HumanitarianPointsWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetMunicipalities  extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/humanitarian_points/get_municipalities',
            operationId: 'getHumanitarianPointsWidgetMunicipalities',
            summary: 'Получить список Муниципалитетов',
            tags: ['HumanitarianPointsWidget'],
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
                                    description: 'Идентификатор муниципалитета',
                                    type: 'integer',
                                    example: 23
                                ),
                                new OA\Property(
                                    property: 'name',
                                    description: 'Название города',
                                    type: 'string',
                                    example: 'Ростов-на-Дону'
                                )
                            ]
                        )
                    )
                )
            ]
        );
    }
}
