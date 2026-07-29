<?php

namespace Modules\Admin\Swagger\Docs\Attributes\AdminUserController;


use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetRoles extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/users/get_roles',
            operationId: 'getRoles',
            summary: 'Получить список ролей',
            tags: ['AdminUserController'],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Success',
                    content: new OA\JsonContent(
                        type: 'array',
                        items: new OA\Items(
                            type: 'object',
                            description: 'Объект описания роли',
                            title: 'Роль',
                            properties: [
                                new OA\Property(
                                    property: 'id',
                                    type: 'integer',
                                    description: 'ID Роли',
                                    example: 1
                                ),
                                new OA\Property(
                                    property: 'name',
                                    type: 'string',
                                    description: 'Название роли',
                                    example: 'create_users'
                                ),
                                new OA\Property(
                                    property: 'russian_name',
                                    type: 'string',
                                    description: 'Русское название роли',
                                    example: 'Создание пользователей'
                                )
                            ]
                        )
                    )
                )
            ]
        );
    }
}
