<?php

namespace Modules\Admin\Swagger\Docs\Attributes\AdminUserController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class LoginByUser extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/users/{user}/login',
            operationId: 'loginByUser',
            summary: 'Авторизоваться под пользователем',
            tags: ['AdminUserController'],
            parameters: [
                new OA\Parameter(
                    name: 'user',
                    in: 'path',
                    required: true,
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
