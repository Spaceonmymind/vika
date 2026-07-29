<?php

namespace Modules\Admin\Swagger\Docs\Attributes\RoleController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class DeleteRole extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/roles/{role}/delete',
            operationId: 'deleteRole',
            summary: 'Удалить роль',
            tags: ['RoleController'],
            parameters: [
                new OA\Parameter(
                    name: 'role',
                    in: 'path',
                    required: true,
                    description: 'Идентификатор роли',
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
