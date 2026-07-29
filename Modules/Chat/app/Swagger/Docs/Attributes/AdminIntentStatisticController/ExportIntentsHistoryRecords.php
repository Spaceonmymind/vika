<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminIntentStatisticController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class ExportIntentsHistoryRecords extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/intents/statistic/export_history',
            operationId: 'exportIntentsHistoryRecords',
            summary: 'Экспорт истории вызовов интентов в Excel',
            tags: ['AdminIntentStatisticController'],
            parameters: [
                new OA\Parameter(
                    name: 'date_from',
                    in: 'query',
                    required: true,
                    schema: new OA\Schema(type: 'string', format: 'date'),
                    description: 'Дата начала периода (не более 180 дней до конца периода)',
                    example: '01.05.2025'
                ),
                new OA\Parameter(
                    name: 'date_to',
                    in: 'query',
                    required: true,
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
                    example: 1
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
                    name: 'intent_id',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'integer'),
                    description: 'ID интента',
                    example: 44
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Excel-файл',
                    content: new OA\MediaType(
                        mediaType: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                        schema: new OA\Schema(type: "string", format: "binary")
                    )
                ),
            ],
        );
    }
}
