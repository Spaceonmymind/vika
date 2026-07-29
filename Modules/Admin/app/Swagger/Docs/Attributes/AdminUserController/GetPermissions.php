<?php

namespace Modules\Admin\Swagger\Docs\Attributes\AdminUserController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetPermissions extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/users/get_permissions',
            operationId: 'getPermissions',
            summary: 'Получить список пермишенов',
            tags: ['AdminUserController'],
            parameters: [
                new OA\Parameter(
                    name: 'roles[]',
                    in: 'query',
                    description: 'Массив ID ролей',
                    required: false,
                    schema: new OA\Schema(
                        type: 'array',
                        items: new OA\Items(type: 'integer'),
                    ),
                ),
                new OA\Parameter(
                    name: 'without_grouping',
                    in: 'query',
                    description: 'Без группировки по присутствию в роли(true - Возвращаются все пермишены,false - Возвращаются пермишены разбитые на входящие в роли и не входящие в роли)',
                    required: false,
                    schema: new OA\Schema(
                        type: 'integer',
                        example: 1,
                    ),
                ),
            ],
            responses: [
                new OA\Response(
                    response: '200',
                    description: 'Success',
                    content: new OA\JsonContent(
                        oneOf: [
                            new OA\Schema(
                                title: 'Ответ с группировкой',
                                type: 'object',
                                properties: [
                                    new OA\Property(
                                        property: 'permissions_in_roles',
                                        type: 'array',
                                        description: 'Массив пермишенов из переданных ролей',
                                        title: 'Массив пермишенов из переданных ролей',
                                        items: new OA\Items(
                                            type: 'object',
                                            properties: [
                                                new OA\Property(
                                                    property: 'id',
                                                    type: 'integer',
                                                    description: 'ID пермишена',
                                                    example: 1,
                                                ),
                                                new OA\Property(
                                                    property: 'name',
                                                    type: 'string',
                                                    description: 'Название пермишена',
                                                    example: 'create_users',
                                                ),
                                                new OA\Property(
                                                    property: 'russian_name',
                                                    type: 'string',
                                                    description: 'Русское название пермишена',
                                                    example: 'Создание пользователей',
                                                ),
                                            ],
                                        ),
                                    ),
                                    new OA\Property(
                                        property: 'permissions_not_in_roles',
                                        type: 'array',
                                        description: 'Массив пермишенов, которые можно доплнительно дать пользователю',
                                        title: 'Массив пермишенов, которые можно доплнительно дать пользователю',
                                        items: new OA\Items(
                                            type: 'object',
                                            properties: [
                                                new OA\Property(
                                                    property: 'id',
                                                    type: 'integer',
                                                    description: 'ID пермишена',
                                                    example: 2,
                                                ),
                                                new OA\Property(
                                                    property: 'name',
                                                    type: 'string',
                                                    description: 'Название пермишена',
                                                    example: 'administrate_chat',
                                                ),
                                                new OA\Property(
                                                    property: 'russian_name',
                                                    type: 'string',
                                                    description: 'Русское название пермишена',
                                                    example: 'Администрирование чата',
                                                ),
                                            ],
                                        ),
                                    ),
                                ],
                            ),
                            new OA\Schema(
                                title: 'Ответ без группировки',
                                type: 'array',
                                items: new OA\Items(
                                    type: 'object',
                                    properties: [
                                        new OA\Property(
                                            property: 'id',
                                            type: 'integer',
                                            description: 'ID пермишена',
                                            example: 1,
                                        ),
                                        new OA\Property(
                                            property: 'name',
                                            type: 'string',
                                            description: 'Название пермишена',
                                            example: 'create_users',
                                        ),
                                        new OA\Property(
                                            property: 'russian_name',
                                            type: 'string',
                                            description: 'Русское название пермишена',
                                            example: 'Создание пользователей',
                                        ),
                                    ],
                                ),

                            ),
                        ],
                        examples: [
                            new OA\Examples(
                                example: 'with_grouping',
                                summary: 'Ответ с группировкой(without_grouping=0)',
                                value: [
                                    'permissions_in_roles' => [
                                        [
                                            'id' => 1,
                                            'name' => 'create_users',
                                            'russian_name' => 'Создание пользователей',
                                        ],
                                    ],
                                    'permissions_not_in_roles' => [
                                        [
                                            'id' => 2,
                                            'name' => 'administrate_chat',
                                            'russian_name' => 'Администрирование чата',
                                        ],
                                    ],
                                ],
                            ),
                            new OA\Examples(
                                example: 'without_grouping',
                                summary: 'Ответ без группировки(without_grouping=1)',
                                value: [
                                    [
                                        'id' => 1,
                                        'name' => 'create_users',
                                        'russian_name' => 'Создание пользователей',
                                    ],
                                ],
                            ),
                        ],
                    ),
                ),
            ],
        );
    }
}
