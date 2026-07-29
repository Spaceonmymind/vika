<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminIntentStatisticController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetIntentStatisticByDays extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/intents/statistic/get_intent_statistic',
            operationId: 'getIntentStatisticByDays',
            summary: 'Получить статистику по интенту по дням',
            tags: ['AdminIntentStatisticController'],
            parameters: [
                new OA\Parameter(
                    name: 'intent_id',
                    in: 'query',
                    required: true,
                    schema: new OA\Schema(type: 'integer'),
                    description: 'ID интента'
                ),
                new OA\Parameter(
                    name: 'date_from',
                    in: 'query',
                    required: true,
                    schema: new OA\Schema(type: 'string', format: 'date'),
                    description: 'Дата начала периода'
                ),
                new OA\Parameter(
                    name: 'date_to',
                    in: 'query',
                    required: true,
                    schema: new OA\Schema(type: 'string', format: 'date'),
                    description: 'Дата конца периода'
                ),
                new OA\Parameter(
                    name: 'vika_type_id',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'integer'),
                    description: 'ID типа Вики'
                ),
                new OA\Parameter(
                    name: 'from_tg',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'integer'),
                    description: 'Источник сообщения (0 - не из Telegram, 1 - из Telegram, null - все)'
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
                    name: 'chat_id',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'string'),
                    description: 'ID чата'
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
                                    property: 'date',
                                    type: 'string',
                                    format: 'date',
                                    description: 'Дата',
                                    example: '20.05.2025'
                                ),
                                new OA\Property(
                                    property: 'count',
                                    type: 'integer',
                                    description: 'Количество вызовов',
                                    example: 150
                                ),
                            ]
                        )
                    )
                ),
            ],
        );
    }
}
