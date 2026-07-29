<?php

namespace Modules\Admin\Swagger\Docs\Attributes\UserController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class SendResetPasswordLink extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/user/send_reset_password_link',
            operationId: 'sendResetPasswordLink',
            summary: 'Отправь на почту письмо со ссылкой для смены пароля',
            tags: ['Auth'],
            requestBody: new OA\RequestBody(
                description: 'Input data',
                required: true,
                content: [
                    new OA\MediaType(
                        mediaType: 'application/json',
                        schema: new OA\Schema(
                            type: 'object',
                            required: ['email'],
                            properties: [
                                new OA\Property(
                                    property: 'email',
                                    description: 'Почта',
                                    type: 'string',
                                    example: 'admin@example.ru',

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
