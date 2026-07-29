<?php
namespace Modules\Chat\Swagger\Docs\Attributes\AdminIntentController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetPlot extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/admin/chat/intents/get_plot',
            operationId: 'getPlot',
            summary: 'Получить график',
            tags: ['AdminIntentController'],
            parameters: [
                new OA\Parameter(
                    name: 'force_update',
                    in: 'query',
                    schema: new OA\Schema(type: 'integer'),
                    description: 'Необходимость принудительного обновления',
                    example: 0
                )
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Success',
                    content: new OA\JsonContent(
                        type: 'object',
                        properties: [
                            new OA\Property(
                                property: 'last_updated_at',
                                type: 'string',
                                description: 'Дата и время последнего обновления',
                                example: '07.05.2025 14:53:58'
                            ),
                            new OA\Property(
                                property: 'error',
                                type: 'string',
                                description: 'текст ошибки',
                                example: 'Не удалось получить график, пожалуйста, попробуйте позже',
                            ),
                            new OA\Property(
                                property: 'plot',
                                type: 'string',
                                description: 'HTML-код графика',
                                example: '<html></html>'
                            ),
                            new OA\Property(
                                property: 'success',
                                type: 'boolean',
                                description: 'Успешность операции',
                                example: true
                            )
                        ]
                    )
                )
            ]
        );
    }
}
