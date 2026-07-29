<?php

namespace Modules\GosZakupkiWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetQuestionCategories extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/gos_zakupki/get_categories",
            operationId: "getGosZakupkiWidgetQuestionCategories",
            summary: "Возвращает список категорий вопросов по госзакупкам",
            tags: ['GosZakupkiWidget'],
            parameters: [
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Successful operation',
                    content: new OA\JsonContent(
                        type: 'array',
                        items: new OA\Items(
                            type: 'object',
                            properties: [
                                new OA\Property(
                                    property: 'id',
                                    description: 'Идентификатор категории вопроса',
                                    type: 'integer',
                                    example: 2
                                ),
                                new OA\Property(
                                    property: 'name',
                                    description: 'Категория вопроса',
                                    type: 'string',
                                    example: 'Ведение планов-графиков. Планирование с 2020 года'
                                ),
                            ]
                        )
                    )
                ),
            ],
        );
    }
}
