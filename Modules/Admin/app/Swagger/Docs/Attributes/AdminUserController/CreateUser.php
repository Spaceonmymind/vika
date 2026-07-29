<?php

namespace Modules\Admin\Swagger\Docs\Attributes\AdminUserController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class CreateUser extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/users/create',
            operationId: 'createUser',
            summary: 'Создать нового пользователя',
            tags: ['AdminUserController'],
            requestBody: new OA\RequestBody(
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        required: ['user', 'person'],
                        properties: [
                            new OA\Property(
                                property: 'user',
                                type: 'object',
                                required: ['email', 'name', 'password', 'roles', 'permissions'],
                                properties: [
                                    new OA\Property(
                                        property: 'email',
                                        type: 'string',
                                        description: 'Почта пользователя',
                                        example: 'user@example.com'
                                    ),
                                    new OA\Property(
                                        property: 'name',
                                        type: 'string',
                                        description: 'Логин пользователя',
                                        example: 'user123'
                                    ),
                                    new OA\Property(
                                        property: 'password',
                                        type: 'string',
                                        description: 'Пароль пользователя',
                                        example: 'password123'
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
                                    )
                                ]
                            ),
                            new OA\Property(
                                property: 'person',
                                type: 'object',
                                required: ['last_name', 'first_name'],
                                properties: [
                                    new OA\Property(
                                        property: 'last_name',
                                        type: 'string',
                                        example: 'Иванов',
                                        description: 'Фамилия'
                                    ),
                                    new OA\Property(
                                        property: 'first_name',
                                        type: 'string',
                                        description: 'Имя',
                                        example: 'Иван'
                                    ),
                                    new OA\Property(
                                        property: 'middle_name',
                                        type: 'string',
                                        description: 'Отчество',
                                        example: 'Иванович'
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
            ],
        );
    }
}
