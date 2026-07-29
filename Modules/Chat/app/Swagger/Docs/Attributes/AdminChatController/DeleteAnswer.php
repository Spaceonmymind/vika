<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminChatController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class DeleteAnswer extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/answers/{answer}/delete',
            operationId: 'deleteAnswer',
            summary: 'Удалить ответ(Нельзя удалять ответы для интентов )',
            tags: ['AdminChatController'],
            parameters: [
                new OA\Parameter(
                    name: 'answer',
                    in: 'path',
                    required: true,
                    description: 'Идентификатор ответа',
                    schema: new OA\Schema(type: 'integer')
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
            ]
        );
    }
}
