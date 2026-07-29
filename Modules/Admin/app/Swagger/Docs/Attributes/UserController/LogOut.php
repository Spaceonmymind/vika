<?php

namespace Modules\Admin\Swagger\Docs\Attributes\UserController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class LogOut extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/user/logout',
            operationId: 'logOut',
            summary: 'Логаут',
            tags: ['Auth'],
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
