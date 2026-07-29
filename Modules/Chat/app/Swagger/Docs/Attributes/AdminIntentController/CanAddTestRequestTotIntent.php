<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminIntentController;


use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class CanAddTestRequestTotIntent extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/intents/{intent}/test_requests/can_create',
            operationId: 'canAddTestRequest',
            summary: 'Проверить можно ли добавить пример вопроса к инетенту',
            tags: ['AdminIntentController'],
            parameters: [
                new OA\Parameter(
                    name: 'intent',
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer'),
                    description: 'ID интента',
                    example: 51
                ),
            ],
            requestBody: new OA\RequestBody(
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        required: ['text'],
                        properties: [
                            new OA\Property(
                                property: 'text',
                                type: 'string',
                                description: 'Текст примера вопроса',
                                example: 'хочу какать'
                            ),
                        ]
                    )
                )
            ),
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Successful operation',
                    content: new OA\JsonContent(
                        type: 'object',
                        properties: [
                            new OA\Property(
                                property: 'can_add',
                                description: 'Можно ли добавить тестовый вопрос к инетенту',
                                type: 'boolean',
                                example: true
                            ),
                            new OA\Property(
                                property: 'description',
                                description: "Какое-то пояснение.\nПри том многострочное",
                                type: 'string',
                                example: 'Тестовый запрос нежелательно добавлять потому что'
                            ),
                            new OA\Property(
                                property: 'metrics',
                                description: 'Набор метрик',
                                type: 'object',
                                properties: [
                                    new OA\Property(
                                        property: 'similarity',
                                        description: 'Похожесть примера ответа на уже добавленный пример ответа в данный интент',
                                        type: 'float',
                                        example: 0.1
                                    ),
                                    new OA\Property(
                                        property: 'similar_test_request',
                                        description: 'Похожий пример ответа из текущего интента',
                                        type: 'object',
                                        properties: [
                                            new OA\Property(
                                                property: 'id',
                                                description: 'Похожесть примера ответа на уже добавленный пример ответа в данный интент',
                                                type: 'integer',
                                                example: 14
                                            ),
                                            
                                            new OA\Property(
                                                property: 'text',
                                                description: 'хочу какать',
                                                type: 'string',
                                                example: 'хочу какать'
                                            ),
                                        ]
                                    ),
                                    new OA\Property(
                                        property: 'intent_density_prev',
                                        description: 'Прошлая кучность интента',
                                        type: 'float',
                                        example: 0.1
                                    ),
                                    new OA\Property(
                                        property: 'intent_density_new',
                                        description: 'Новая кучность интента',
                                        type: 'float',
                                        example: 0.15
                                    ),
                                    new OA\Property(
                                        property: 'distant_to_nearest_intent_prev',
                                        description: 'Прошлое расстояние до ближайшего интента',
                                        type: 'float',
                                        example: 0.1
                                    ),
                                    new OA\Property(
                                        property: 'distant_to_nearest_intent_new',
                                        description: 'Новое расстояние до ближайшего интента',
                                        type: 'float',
                                        example: 0.15
                                    ),
                                    new OA\Property(
                                        property: 'nearest_intent_sample',
                                        description: 'Пример ответа, с которым идет пересечение',
                                        type: 'object',
                                        properties: [
                                            new OA\Property(
                                                property: 'id',
                                                description: 'Похожесть примера ответа на уже добавленный пример ответа в данный интент',
                                                type: 'integer',
                                                example: 14
                                            ),
                                            new OA\Property(
                                                property: 'text',
                                                description: 'Текст тестового запроса',
                                                type: 'string',
                                                example: 'хочу какать'
                                            ),
                                            new OA\Property(
                                                property: 'intent_id',
                                                description: 'Идентификатор интента, к которому привязан пример запроса',
                                                type: 'integer',
                                                example: 59
                                            ),
                                            new OA\Property(
                                                property: 'chat_intent',
                                                description: 'Идентификатор интента, к которому привязан пример запроса',
                                                type: 'object',
                                                properties: [
                                                    new OA\Property(
                                                        property: 'id',
                                                        description: 'Похожесть примера ответа на уже добавленный пример ответа в данный интент',
                                                        type: 'integer',
                                                        example: 59
                                                    ),
                                                    new OA\Property(
                                                        property: 'name',
                                                        description: 'Интент тестового запроса, с которым идет пересечение',
                                                        type: 'string',
                                                        example: 'Новый тестовый интент'
                                                    ),
                                                    new OA\Property(
                                                        property: 'code',
                                                        description: 'Код интента',
                                                        type: 'string',
                                                        example: 'test.test22222'
                                                    ),
                                                ]
                                            ),
                                        ],
                                    ),
                                ]
                            ),
                        ],
                    ),
                ),
            ],
        );
    }
}
