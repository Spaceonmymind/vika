<?php

namespace Modules\GosZakupkiWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetQuestions extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/gos_zakupki/get_questions",
            operationId: "getGosZakupkiWidgetQuestions",
            summary: "Возвращает список вопросов по госзакупкам",
            tags: ['GosZakupkiWidget'],
            parameters: [
                new OA\Parameter(
                    name: 'category_id',
                    in: 'query',
                    required: false,
                    description: 'Идентификатор категории вопросов',
                    schema: new OA\Schema(
                        type: 'integer',
                    ),
                    example: 2,
                ),
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
                                    description: 'Идентификатор вопроса',
                                    type: 'integer',
                                    example: 6
                                ),
                                new OA\Property(
                                    property: 'question',
                                    description: 'Вопрос',
                                    type: 'string',
                                    example: 'Порядок формирования версии плана-графика'
                                ),
                                new OA\Property(
                                    property: 'answer',
                                    description: 'Ответ',
                                    type: 'string',
                                    example: "Сроки предоставления отчетных форм по формированию, исполнению плана-графика закупок утверждены Методическими рекомендациями (приложение 2) Приказа Депгосзаказа Югры  от 08.07.2022 № 74 «Об утверждении методических рекомендаций по планированию закупок, отчетных форм по формированию, исполнению плана-графика закупок товаров, работ, услуг для обеспечения нужд Ханты-Мансийского автономного округа – Югры»\n(На сайте-раздел Документы-Приказы Департамента)",
                                ),
                                new OA\Property(
                                    property: 'link',
                                    description: 'Ссылка на документ',
                                    type: 'string',
                                    example: 'https://help.krista.ru/kb/3444'
                                ),
                                new OA\Property(
                                    property: 'category_id',
                                    description: 'Идентификатор категории вопроса',
                                    type: 'integer',
                                    example: 2
                                ),
                                new OA\Property(
                                    property: 'category',
                                    description: 'Категория вопроса',
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
                                ),

                            ]
                        )
                    )
                ),
            ],
        );
    }
}
