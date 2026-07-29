<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminIntentController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetIntent extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/intents/{intent}/get',
            operationId: 'getIntent',
            summary: 'Получить интент по ID',
            tags: ['AdminIntentController'],
            parameters: [
                new OA\Parameter(
                    name: 'intent',
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer'),
                    description: 'ID интента',
                    example: 51
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Описание интента',
                    content: new OA\JsonContent(
                        type: 'object',
                        properties: [
                            new OA\Property(
                                property: 'id',
                                type: 'integer',
                                description: 'ID интента',
                                example: 40,
                            ),
                            new OA\Property(
                                property: 'code',
                                type: 'string',
                                description: 'Код интента',
                                example: 'residence_permit',
                            ),
                            new OA\Property(
                                property: 'name',
                                type: 'string',
                                description: 'Название интента',
                                example: 'Регистрация (прописка)',
                            ),
                            new OA\Property(
                                property: 'custom_handler_class',
                                type: 'string',
                                description: 'Класс обработчика интента',
                                example: 'Modules\\Chat\\IntentHandlers\\DefaultChatHandler',
                            ),
                            new OA\Property(
                                property: 'active',
                                type: 'boolean',
                                description: 'Активность интента',
                                example: true,
                            ),
                            new OA\Property(
                                property: 'handler_id',
                                type: 'integer',
                                description: 'ID обработчика интента',
                                example: 1,
                            ),
                            new OA\Property(
                                property: 'external_id',
                                type: 'integer',
                                description: 'Внешний ID интента',
                                example: 54,
                            ),
                            new OA\Property(
                                property: 'document',
                                type: 'string',
                                description: 'Документ по интенту',
                                example: "Вопрос: Регистрация по месту пребывания\r\nОтвет:\r\nГражданин представляет должностному лицу, ответственному за регистрацию, а при его отсутствии - собственнику жилого помещения:\r\n\r\n\r\nЗаявление о регистрации по месту пребывания, подписанное гражданином и собственником (нанимателем) жилого помещения, указанного в заявлении. Подписи заверяются должностным лицом, ответственным за регистрацию.\r\nДокумент, удостоверяющий личность.\r\nДокумент, являющийся основанием для временного проживания в жилом помещении, права на которое не зарегистрированы в Едином государственном реестре недвижимости.\r\nАкт органа опеки и попечительства о назначении опекуна или попечителя (при установлении опеки или попечительства).\r\nПисьменное согласие о вселении гражданина в жилое помещение от проживающих совместно с нанимателем жилого помещения совершеннолетних пользователей, наймодателя и всех участников долевой собственности (при необходимости)."
                            ),
                            new OA\Property(
                                property: 'system_prompt',
                                type: 'string',
                                description: 'Системный промпт для интента',
                                example: "Представь, что ты  работник миграционной службы, к тебе обращаются по вопросам получения регистрации и прописки.\r\nТебе необходимо кратко ответить на вопросы связанные с получением прописки.\r\nОтвет должен быть кратким и структурированым, но отвечающим на запрос пользователя.\r\nВыдели только важные моменты и ключевые факты.Твоя задача помочь пользователю с ответом.",
                            ),
                            new OA\Property(
                                property: 'test_requests',
                                type: 'array',
                                description: 'Список примеров ответов',
                                items: new OA\Items(
                                    type: 'object',
                                    properties: [
                                        new OA\Property(
                                            property: 'id',
                                            type: 'integer',
                                            description: 'ID тестового запроса',
                                            example: 591,
                                        ),
                                        new OA\Property(
                                            property: 'intent_id',
                                            type: 'integer',
                                            description: 'ID интента',
                                            example: 40,
                                        ),
                                        new OA\Property(
                                            property: 'text',
                                            type: 'string',
                                            description: 'Текст тестового запроса',
                                            example: 'прописать человека в квартиру',
                                        ),
                                        new OA\Property(
                                            property: 'external_id',
                                            description: 'Внешний ID тестового запроса',
                                            type: 'integer',
                                            example: 600,
                                        ),
                                        new OA\Property(
                                            property: 'created_at',
                                            type: 'string',
                                            description: 'Дата создания тестового запроса',
                                            format: 'date-time',
                                            example: '2025-05-06T11:07:21.000000Z',
                                        ),
                                        new OA\Property(
                                            property: 'updated_at',
                                            type: 'string',
                                            description: 'Дата обновления тестового запроса',
                                            format: 'date-time',
                                            example: '2025-05-06T11:07:21.000000Z',
                                        ),
                                    ],
                                ),
                            ),
                            new OA\Property(
                                property: 'handler',
                                type: 'object',
                                description: 'Объект обработчика',
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
                            ),
                        ],

                    ),
                ),
            ],
        );
    }
}

