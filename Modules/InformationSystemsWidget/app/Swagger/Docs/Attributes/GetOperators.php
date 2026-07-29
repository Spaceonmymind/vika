<?php

namespace Modules\InformationSystemsWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetOperators extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/information_systems/get_operators',
            operationId: 'getListOfOperators',
            summary: 'Получить список операторов',
            tags: ['InformationSystemsWidget'],
            parameters: [],
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
                                    type: 'integer',
                                    example: 1,
                                ),
                                new OA\Property(
                                    property: 'name',
                                    type: 'string',
                                    example: 'Депнедра и природных ресурсов Югры',
                                ),
                            ]
                        )
                    )
                )
            ]
        );
    }
}
