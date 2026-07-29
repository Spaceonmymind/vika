<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminIntentController;


use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class DeleteTestRequestFromIntent extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/intents/test_requests/{testRequest}/delete',
            operationId: 'deleteTestRequest',
            summary: 'Удалить пример вопроса к инетенту',
            tags: ['AdminIntentController'],
            parameters: [
                new OA\Parameter(
                    name: 'testRequest',
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer'),
                    description: 'ID примера вопроса',
                    example: 1
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Successful operation',
                    content: new OA\JsonContent(
                        type: 'object',
                        properties: [
                            new OA\Property(
                                property: 'success',
                                description: 'Успешность выполнения операции',
                                type: 'boolean',
                                example: true
                            ),
                        ],
                    ),
                ),
            ],
        );
    }
}
