<?php

namespace Modules\Admin\Swagger\Docs\Attributes\UserController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetToken  extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/user/get_token',
            operationId: 'getToken',
            summary: 'Получение токена для мобилки',
            tags: ['Auth'],
            requestBody: new OA\RequestBody(
                description: 'Input data',
                required: true,
                content: [
                    new OA\MediaType(
                        mediaType: 'application/json',
                        schema: new OA\Schema(
                            type: 'object',
                            required: ['email', 'password', 'device_name'],
                            properties: [
                                new OA\Property(
                                    property: 'email',
                                    description: 'Логин или почта',
                                    type: 'string',
                                    example: 'admin',

                                ),
                                new OA\Property(
                                    property: 'password',
                                    description: 'Пароль',
                                    type: 'string',
                                    example: 'password',
                                    minLength: 8
                                ),
                                new OA\Property(
                                    property: 'device_name',
                                    description: 'Название устройства',
                                    type: 'string',
                                    example: 'web',
                                ),
                            ],
                        ),
                    ),
                ],
            ),
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Successful operation',
                    content: new OA\JsonContent(
                        type: 'array',
                        items: new OA\Items(
                            type: 'object',
                            properties: [
                                new OA\Property(
                                    property: 'token',
                                    description: 'Berear токен для авторизации',
                                    type: 'string',
                                    example: '1|2TArXmkC7Iz2c9ULbkgxbGU4AlA77Peevwvk4GOG2fc05928'
                                ),
                            ]
                        )
                    )
                ),
                new OA\Response(
                    response: 401,
                    description: 'Failed operation',
                    content: new OA\JsonContent(
                        type: 'array',
                        items: new OA\Items(
                            type: 'object',
                            properties: [
                                new OA\Property(
                                    property: 'error',
                                    description: 'Описание ошибки',
                                    type: 'string',
                                    example: 'Неверный логин или пароль.'
                                ),
                            ]
                        )
                    )
                ),
            ]
        );
    }
}
