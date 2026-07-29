<?php

namespace Modules\PfrHelpWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetServices extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/pfr_help/get_services',
            operationId: 'getPfrHelpWidgetServices',
            summary: 'Получить список услуг',
            tags: ['PfrHelpWidget'],
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
                                    description: 'Идентификатор услуги',
                                    type: 'integer',
                                    example: 1
                                ),
                                new OA\Property(
                                    property: 'name',
                                    description: 'Наименование услуги',
                                    type: 'string',
                                    example: 'Ежемесячное пособие на ребенка в возрасте от 8 до 17 лет'
                                ),

                            ]
                        )
                    )
                )
            ]
        );
    }
}
