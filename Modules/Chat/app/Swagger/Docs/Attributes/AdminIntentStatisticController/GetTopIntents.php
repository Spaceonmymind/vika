<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminIntentStatisticController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetTopIntents extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/intents/statistic/get_top',
            operationId: 'getTopIntents',
            summary: 'Получить топ интентов',
            tags: ['AdminIntentStatisticController'],
            parameters: [
                new OA\Parameter(
                    name: 'date_from',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'string', format: 'date'),
                    description: 'Дата начала периода',
                    example: '01.05.2025'
                ),
                new OA\Parameter(
                    name: 'date_to',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'string', format: 'date'),
                    description: 'Дата конца периода',
                    example: '31.05.2025'
                ),
                new OA\Parameter(
                    name: 'vika_type_id',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'integer'),
                    description: 'ID типа Вики',
                    example: 1
                ),
                new OA\Parameter(
                    name: 'chat_id',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'string'),
                    description: 'ID чата',
                    example: '3a945988-ec00-46a2-868b-f078f6ba5353'
                ),
                new OA\Parameter(
                    name: 'from_tg',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'integer'),
                    description: 'Источник сообщения (0 - не из Telegram, 1 - из Telegram, null - все)',
                    example: 0
                ),
                new OA\Parameter(
                    name: 'from_max',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'integer'),
                    description: 'Источник сообщения (0 - не из Max, 1 - из Max, null - все)',
                    example: 1
                ),
                new OA\Parameter(
                    name: 'limit',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'integer'),
                    description: 'Лимит записей',
                    example: 2
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Успешный ответ',
                    content: new OA\JsonContent(
                        type: 'array',
                        items: new OA\Items(
                            properties: [
                                new OA\Property(
                                    property: 'count',
                                    type: 'integer',
                                    description: 'Количество вызовов',
                                    example: 3,
                                ),
                                new OA\Property(
                                    property: 'intent_id',
                                    type: 'integer',
                                    description: 'ID интента',
                                    example: 10,
                                ),
                                new OA\Property(
                                    property: 'chat_intent',
                                    type: 'object',
                                    description: 'Информация об интенте',
                                    properties: [
                                        new OA\Property(
                                            property: 'id',
                                            type: 'integer',
                                            description: 'ID интента',
                                            example: 10,
                                        ),
                                        new OA\Property(
                                            property: 'code',
                                            type: 'string',
                                            description: 'Код интента',
                                            example: 'welcome',
                                        ),
                                        new OA\Property(
                                            property: 'name',
                                            type: 'string',
                                            description: 'Название интента',
                                            example: 'Default Welcome Intent',
                                        ),
                                        new OA\Property(
                                            property: 'active',
                                            type: 'boolean',
                                            description: 'Активен ли интент',
                                            example: true,
                                        ),
                                    ]
                                ),
                            ]
                        )
                    )
                ),
            ],
        );
    }
}
