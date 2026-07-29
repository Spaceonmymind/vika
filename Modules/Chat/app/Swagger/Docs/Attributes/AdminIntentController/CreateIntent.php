<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminIntentController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class CreateIntent extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/intents/create',
            operationId: 'createIntent',
            summary: 'Создать интент',
            tags: ['AdminIntentController'],
            requestBody: new OA\RequestBody(
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        required: ['name', 'code', 'active', 'handler_id'],
                        properties: [
                            new OA\Property(
                                property: 'name',
                                type: 'string',
                                description: 'Название интента',
                                example: 'Новый тестовый интент'
                            ),
                            new OA\Property(
                                property: 'code',
                                type: 'string',
                                description: 'Код инетента',
                                example: 'test.test'
                            ),
                            new OA\Property(
                                property: 'active',
                                type: 'boolean',
                                description: 'Активность интента',
                                example: true
                            ),
                            new OA\Property(
                                property: 'handler_id',
                                type: 'integer',
                                description: 'ID обработчика интента',
                                example: 1
                            ),
                            new OA\Property(
                                property: 'document',
                                type: 'string-longtext',
                                description: 'Документ интента, по которому будет осуществляться поиск для генерации ответа',
                                example: 'Запись ребенка в 1-й класс производится на портале государственных услуг gosuslugi.ru...',
                                nullable: true
                            ),
                            new OA\Property(
                                property: 'system_prompt',
                                type: 'string-longtext',
                                description: 'Системный промпт для БЯМ, который будет использоваться для генерации ответа',
                                example: 'Представь, что ты - консультант департамента образования. Твоя задача - отвечать на вопросы пользователей по теме записи детей в 1-й класс.',
                                nullable: true
                            ),
                        ]
                    )
                )
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
                                example: true
                            ),
                        ],
                    ),
                ),
            ],
        );
    }
}
