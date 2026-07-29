<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminIntentController;


use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class DeleteIntent extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/intents/{intent}/delete',
            operationId: 'deleteIntent',
            summary: 'Удалить инетент',
            tags: ['AdminIntentController'],
            parameters: [
                new OA\Parameter(
                    name: 'intent',
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer'),
                    description: 'ID интента',
                    example: 51
                )
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
