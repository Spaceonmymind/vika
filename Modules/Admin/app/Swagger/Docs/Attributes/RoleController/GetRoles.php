<?php

namespace Modules\Admin\Swagger\Docs\Attributes\RoleController;


use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetRoles extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/roles/list',
            operationId: 'getPaginatedRoles',
            summary: 'Получить список ролей',
            tags: ['RoleController'],
            parameters: [
                new OA\Parameter(
                    name: 'name',
                    in: 'query',
                    schema: new OA\Schema(type: 'string'),
                    description: 'Фильтр по русскому названию роли',
                    example: 'Новая роль',
                ),
                new OA\Parameter(
                    name: 'per_page',
                    in: 'query',
                    schema: new OA\Schema(type: 'integer'),
                    description: 'Количество элементов на странице',
                    example: 15,
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Successful operation',
                    content: new OA\JsonContent(
                        type: "object",
                        allOf: [
                            new OA\Property(ref: '#/components/schemas/LengthAwarePaginator'),
                            new OA\Schema(
                                properties: [
                                    new OA\Property(
                                        property: 'data',
                                        description: 'Список ролей',
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
                                            ],
                                        ),
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
