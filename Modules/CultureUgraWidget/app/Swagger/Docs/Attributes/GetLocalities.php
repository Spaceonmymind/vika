<?php

namespace Modules\CultureUgraWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetLocalities  extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/culture_ugra/get_localities',
            operationId: 'getCultureUgraWidgetLocalities',
            summary: 'Получить список городов',
            tags: ['CultureUgraWidget'],
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
                                    example: 155
                                ),
                                new OA\Property(
                                    property: 'name',
                                    description: 'Название города',
                                    type: 'string',
                                    example: 'Радужный'
                                )
                            ]
                        )
                    )
                )
            ]
        );
    }
}
