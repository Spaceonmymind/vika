<?php

namespace Modules\SocialSupportWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetSituations  extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/social_support/get_situations',
            operationId: 'getSocialSupportWidgetSituations',
            summary: 'Получить список жизненных ситуаций',
            tags: ['SocialSupportWidget'],
            parameters: [

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
                                    description: 'Идентификатор жизненной ситуации',
                                    type: 'integer',
                                    example: 1
                                ),
                                new OA\Property(
                                    property: 'name',
                                    description: 'Название жизненной ситуации',
                                    type: 'string',
                                    example: 'Беременность и рождение ребенка'
                                )
                            ]
                        )
                    )
                )
            ]
        );
    }
}
