<?php

namespace Modules\InformationSystemsWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetOwners extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/information_systems/get_owners',
            operationId: 'getListOfOwners',
            summary: 'Получить список владельцев',
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
                                    example: 24,
                                ),
                                new OA\Property(
                                    property: 'name',
                                    type: 'string',
                                    example: 'ДЕПИНФОРМТЕХНОЛОГИЙ ЮГРЫ',
                                ),
                            ]
                        )
                    )
                )
            ]
        );
    }
}
