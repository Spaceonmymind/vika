<?php

namespace Modules\Admin\Swagger\Docs\Attributes\UserController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class ResetPassword  extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/user/reset_password',
            operationId: 'resetPassword',
            summary: 'Поменять пароль у аккаунта',
            tags: ['Auth'],
            requestBody: new OA\RequestBody(
                description: 'Input data',
                required: true,
                content: [
                    new OA\MediaType(
                        mediaType: 'application/json',
                        schema: new OA\Schema(
                            type: 'object',
                            required: ['email','token','password'],
                            properties: [
                                new OA\Property(
                                    property: 'email',
                                    description: 'Почта',
                                    type: 'string',
                                    example: 'admin@example.ru',

                                ),
                                new OA\Property(
                                    property: 'token',
                                    description: 'Токен, необходимый для смены пароля, который пришёл в письме',
                                    type: 'string',
                                    example: 'd02f942b308230dd1057e22b93a3f49d59ff2d0a48cba176d0b5d42ca68598ba',

                                ),
                                new OA\Property(
                                    property: 'password',
                                    description: 'Новый пароль от аккаунта',
                                    type: 'string',
                                    example: '123456789',

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
                        type: 'object',
                        properties: [
                            new OA\Property(
                                property: 'success',
                                description: 'Успешность выполнения операции',
                                type: 'boolean',
                                example: true,
                            ),
                        ],
                    ),
                ),
            ],
        );
    }
}
