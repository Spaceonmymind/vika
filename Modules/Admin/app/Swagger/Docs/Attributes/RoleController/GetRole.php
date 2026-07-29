<?php

namespace Modules\Admin\Swagger\Docs\Attributes\RoleController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetRole extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/roles/{role}/get',
            operationId: 'getRole',
            summary: 'Получить детальную информацию о роли',
            tags: ['RoleController'],
            parameters: [
                new OA\Parameter(
                    name: 'role',
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer'),
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Success',
                    content: new OA\JsonContent(
                        type: 'object',
                        properties: [
                            new OA\Property(
                                property: 'id',
                                type: 'integer',
                                description: 'ID Роли',
                                example: 1,
                            ),
                            new OA\Property(
                                property: 'name',
                                type: 'string',
                                description: 'Название роли',
                                example: 'create_users',
                            ),
                            new OA\Property(
                                property: 'russian_name',
                                type: 'string',
                                description: 'Русское название роли',
                                example: 'Создание пользователей',
                            ),
                            new OA\Property(
                                property: 'users_count',
                                type: 'integer',
                                description: 'Количество пользователей с данной ролью',
                                example: 0,
                            ),
                            new OA\Property(
                                property: 'permissions',
                                description: 'Массив пермишенов',
                                type: 'array',
                                items: new OA\Items(
                                    type: 'object',
                                    properties: [
                                        new OA\Property(
                                            property: 'id',
                                            description: 'Идентификатор пермишена',
                                            type: 'integer',
                                            example: 1
                                        ),
                                        new OA\Property(
                                            property: 'name',
                                            description: 'Название пермишена',
                                            type: 'string',
                                            example: 'administrate_users'
                                        ),
                                        new OA\Property(
                                            property: 'russian_name',
                                            description: 'Русское название пермишена',
                                            type: 'string',
                                            example: 'Администрирование пользователей'
                                        ),

                                    ]
                                ),
                            ),
                        ],
                    ),
                ),
            ],
        );
    }
}
