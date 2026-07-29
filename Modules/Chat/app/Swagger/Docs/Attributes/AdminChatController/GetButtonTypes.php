<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminChatController;


use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetButtonTypes extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/button_types/list',
            operationId: 'getButtonTypes',
            summary: 'Получить список типов кнопок',
            tags: ['AdminChatController'],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Success',
                    content: new OA\JsonContent(
                        type: 'array',
                        items: new OA\Items(
                            type: 'object',
                            description: 'Объект описания типа кнопки',
                            title: 'Роль',
                            properties: [
                                new OA\Property(
                                    property: 'id',
                                    type: 'integer',
                                    description: 'ID типа кнопки',
                                    example: 1
                                ),
                                new OA\Property(
                                    property: 'code',
                                    type: 'string',
                                    description: 'Название типа кнопки',
                                    example: 'widget'
                                ),
                                new OA\Property(
                                    property: 'name',
                                    type: 'string',
                                    description: 'Название типа кнопки',
                                    example: 'Кнопка для открытия виджета'
                                )
                            ]
                        )
                    )
                )
            ]
        );
    }
}
