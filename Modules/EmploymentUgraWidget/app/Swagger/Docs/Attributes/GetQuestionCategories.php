<?php

namespace Modules\EmploymentUgraWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetQuestionCategories extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/employment_ugra/get_categories',
            operationId: 'getEmploymentUgraWidgetQuestionCategories',
            summary: 'Получить список типов категорий вопросов по занятости в Югре',
            tags: ['EmploymentUgraWidget'],
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
                                    description: 'Идентификатор категории',
                                    type: 'integer',
                                    example: 1
                                ),
                                new OA\Property(
                                    property: 'name',
                                    description: 'Значение категории',
                                    type: 'string',
                                    example: 'Содействие трудоустройству'
                                ),

                            ]
                        )
                    )
                )
            ]
        );
    }
}
