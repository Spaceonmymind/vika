<?php

namespace Modules\Admin\Swagger\Docs\Attributes\AdminUserController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class UpdateUser extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/users/{user}/update',
            operationId: 'updateUser',
            summary: 'Обновить данные пользователя',
            tags: ['AdminUserController'],
            parameters: [
                new OA\Parameter(
                    name: 'user',
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer'),
                    description: 'ID пользователя'
                )
            ],
            requestBody: new OA\RequestBody(
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        properties: [
                            new OA\Property(
                                property: 'user',
                                type: 'object',
                                properties: [
                                    new OA\Property(
                                        property: 'email',
                                        type: 'string',
                                        format: 'email',
                                        description: 'Почта',
                                        example: 'new@example.com'
                                    ),
                                    new OA\Property(
                                        property: 'name',
                                        type: 'string',
                                        description: 'Логин',
                                        example: 'new_username'
                                    ),
                                    new OA\Property(
                                        property: 'password',
                                        type: 'string',
                                        description: 'Пароль',
                                        example: 'new_password123'
                                    ),
                                    new OA\Property(
                                        property: 'is_active',
                                        description: 'Признак активности пользователя',
                                        type: 'boolean',
                                        example: true
                                    ),
                                    new OA\Property(
                                        property: 'roles',
                                        type: 'array',
                                        description: 'Роли пользователя',
                                        items: new OA\Items(type: 'integer',example: 1)
                                    ),
                                    new OA\Property(
                                        property: 'permissions',
                                        type: 'array',
                                        description: 'Права пользователя',
                                        items: new OA\Items(type: 'integer',example: 2)
                                    ),
                                ]
                            ),
                            new OA\Property(
                                property: 'person',
                                type: 'object',
                                properties: [
                                    new OA\Property(
                                        property: 'last_name',
                                        type: 'string',
                                        description: 'Фамилия',
                                        example: 'Петров'
                                    ),
                                    new OA\Property(
                                        property: 'first_name',
                                        type: 'string',
                                        description: 'Имя',
                                        example: 'Пётр'
                                    ),
                                    new OA\Property(
                                        property: 'middle_name',
                                        type: 'string',
                                        description: 'Отчество',
                                        example: 'Пётрович'
                                    )
                                ]
                            )
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
