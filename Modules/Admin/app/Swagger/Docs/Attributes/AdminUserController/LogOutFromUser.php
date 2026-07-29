<?php

namespace Modules\Admin\Swagger\Docs\Attributes\AdminUserController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class LogOutFromUser extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/user/logout_from_another_user',
            operationId: 'logOutFromUser',
            summary: 'Вернуться к старому пользователю',
            tags: ['AdminUserController'],
            parameters: [
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
