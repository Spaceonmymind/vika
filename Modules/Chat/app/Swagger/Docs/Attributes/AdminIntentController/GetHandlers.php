<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminIntentController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetHandlers extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/intents/get_handlers',
            operationId: 'getHandlers',
            summary: 'Получить список обработчиков интентов',
            tags: ['AdminIntentController'],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Список обработчиков интентов',
                    content: new OA\JsonContent(
                        type: 'array',
                        items: new OA\Items(
                            type: 'object',
                            properties: [
                                new OA\Property(
                                    property: 'id',
                                    type: 'integer',
                                    description: 'ID обработчика',
                                    example: 1
                                ),
                                new OA\Property(
                                    property: 'code',
                                    type: 'string',
                                    description: 'Код обработчика',
                                    example: 'default'
                                ),
                                new OA\Property(
                                    property: 'name',
                                    type: 'string',
                                    description: 'Название обработчика',
                                    example: 'Стандартный'
                                ),
                                new OA\Property(
                                    property: 'class',
                                    type: 'string',
                                    description: 'Класс обработчика',
                                    example: 'Modules\\Chat\\IntentHandlers\\DefaultChatHandler'
                                ),
                            ]
                        )
                    )
                )
            ]
        );
    }
}
