<?php

namespace Modules\Admin\Swagger\Docs\Attributes\AdminUserController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetDetailUserInformation extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/users/{user}/get',
            operationId: 'getDetailUserInformation',
            summary: 'Получить детальную информацию о пользователе',
            tags: ['AdminUserController'],
            parameters: [
                new OA\Parameter(
                    name: 'user',
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
                                description: 'Идентификатор пользователя',
                                type: 'integer',
                                example: 1,
                            ),
                            new OA\Property(
                                property: 'name',
                                description: 'Имя пользователя(логин)',
                                type: 'string',
                                example: 'admin',
                            ),
                            new OA\Property(
                                property: 'email',
                                description: 'Почта пользователя',
                                type: 'string',
                                example: 'admin@example.ru',
                            ),
                            new OA\Property(
                                property: 'email_verified_at',
                                description: 'Время подтверждения почты',
                                type: 'string',
                                example: '2025-04-03T05:42:59.000000Z',
                            ),
                            new OA\Property(
                                property: 'created_at',
                                description: 'Время создания',
                                type: 'string',
                                example: '2025-04-03T05:42:59.000000Z',
                            ),
                            new OA\Property(
                                property: 'updated_at',
                                description: 'Время последнего изменения',
                                type: 'string',
                                example: '2025-04-03T05:42:59.000000Z',
                            ),
                            new OA\Property(
                                property: 'last_logged_in',
                                description: 'Время последней авторизации',
                                type: 'string',
                                example: '17.04.2025 17:08:35',
                            ),
                            new OA\Property(
                                property: 'is_active',
                                description: 'Признак активности пользователя',
                                type: 'boolean',
                                example: true,
                            ),
                            new OA\Property(
                                property: 'roles',
                                description: 'Массив ролей',
                                type: 'array',
                                items: new OA\Items(
                                    type: 'object',
                                    properties: [
                                        new OA\Property(
                                            property: 'id',
                                            description: 'Идентификатор роли',
                                            type: 'integer',
                                            example: 1,
                                        ),
                                        new OA\Property(
                                            property: 'name',
                                            description: 'Название роли',
                                            type: 'string',
                                            example: 'superuser',
                                        ),
                                        new OA\Property(
                                            property: 'russian_name',
                                            description: 'Русское название роли',
                                            type: 'string',
                                            example: 'Супер пользователь',
                                        ),

                                    ],
                                ),
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
                                            example: 1,
                                        ),
                                        new OA\Property(
                                            property: 'name',
                                            description: 'Название пермишена',
                                            type: 'string',
                                            example: 'administrate_users',
                                        ),
                                        new OA\Property(
                                            property: 'russian_name',
                                            description: 'Русское название пермишена',
                                            type: 'string',
                                            example: 'Администрирование пользователей',
                                        ),

                                    ],
                                ),
                            ),
                            new OA\Property(
                                property: 'person',
                                type: 'object',
                                description: 'Объект с информацией о человеке',
                                title: 'Объект с информацией о человеке',
                                properties: [
                                    new OA\Property(
                                        property: 'id',
                                        description: 'Идентификатор пёрсона',
                                        type: 'integer',
                                        example: 1,
                                    ),
                                    new OA\Property(
                                        property: 'last_name',
                                        description: 'Фамилия',
                                        type: 'string',
                                        example: 'Колесников',
                                    ),
                                    new OA\Property(
                                        property: 'first_name',
                                        description: 'Имя',
                                        type: 'string',
                                        example: 'Андрей',
                                    ),
                                    new OA\Property(
                                        property: 'middle_name',
                                        description: 'Отчество',
                                        type: 'string',
                                        example: 'Владимирович',
                                    ),
                                    new OA\Property(
                                        property: 'user_id',
                                        description: 'Идентификатор пользователя',
                                        type: 'integer',
                                        example: 1,
                                    ),

                                ],
                            ),
                        ],
                    ),
                ),
            ],
        );
    }
}
