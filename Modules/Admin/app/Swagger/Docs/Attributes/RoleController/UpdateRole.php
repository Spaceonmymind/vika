<?php

namespace Modules\Admin\Swagger\Docs\Attributes\RoleController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class UpdateRole extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/roles/{role}/update',
            operationId: 'updateRole',
            summary: 'Обновить данные роли',
            tags: ['RoleController'],
            parameters: [
                new OA\Parameter(
                    name: 'role',
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer'),
                    description: 'ID Роли'
                )
            ],
            requestBody: new OA\RequestBody(
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        required: ['permissions'],
                        properties: [
                            new OA\Property(
                                property: 'name',
                                type: 'string',
                                description: 'Название роли на английском',
                                example: 'new_role2'
                            ),
                            new OA\Property(
                                property: 'russian_name',
                                type: 'string',
                                description: 'Название роли на русском',
                                example: 'Новая роль'
                            ),
                            new OA\Property(
                                property: 'permissions',
                                type: 'array',
                                description: 'Список пермишенов',
                                items: new OA\Items(type: 'integer',example: 1)
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
