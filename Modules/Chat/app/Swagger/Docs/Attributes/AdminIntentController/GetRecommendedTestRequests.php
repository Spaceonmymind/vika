<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminIntentController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetRecommendedTestRequests extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/intents/{intentId}/get_recommendations',
            operationId: 'getRecommendedTestRequests',
            summary: 'Получить рекомендуемые примеры вопросов для интента',
            tags: ['AdminIntentController'],
            parameters: [
                new OA\Parameter(
                    name: 'intentId',
                    in: 'path',
                    schema: new OA\Schema(type: 'ineger'),
                    description: 'Идентификатор интента',
                    example: 22
                )
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Success',
                    content: new OA\JsonContent(
                        type: 'array',
                        description: 'Список рекомендуемых примеров вопросов для интента',
                        items: new OA\Items(
                            type: 'string',
                            description: 'Пример вопроса',
                            example: 'как получить льготный рецепт?'
                        )
                    )
                )
            ]
        );
    }
}

