<?php

namespace Modules\PfrHelpWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetCategories  extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/pfr_help/get_categories',
            operationId: 'getPfrHelpWidgetCategories',
            summary: 'Получить список категорий вопросов',
            tags: ['PfrHelpWidget'],
            parameters: [
               new OA\Parameter(
                   name: 'service_id',
                   description: 'Идентификатор услуги',
                   required: false,
                   in: 'query',
                   example: 1
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
                                    description: 'Идентификатор категории',
                                    type: 'integer',
                                    example: 1
                                ),
                                new OA\Property(
                                    property: 'name',
                                    description: 'Наименование категории',
                                    type: 'string',
                                    example: 'Как подать заявление?'
                                ),
                                new OA\Property(
                                    property: 'service_id',
                                    description: 'Идентификатор услуги',
                                    type: 'integer',
                                    example: 1
                                ),

                            ]
                        )
                    )
                )
            ]
        );
    }
}
