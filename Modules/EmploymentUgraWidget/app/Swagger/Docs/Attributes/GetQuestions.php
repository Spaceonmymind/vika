<?php

namespace Modules\EmploymentUgraWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetQuestions  extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/employment_ugra/get_questions',
            operationId: 'getEmploymentUgraWidgetQuestions',
            summary: 'Получить список вопросов по занятости в Югре',
            tags: ['EmploymentUgraWidget'],
            parameters: [
                new OA\Parameter(
                    name: 'category_id',
                    in: 'query',
                    description: 'Идентификатор категории',
                    required: false
                )
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
                                    example: 1
                                ),
                                new OA\Property(
                                    property: 'question',
                                    description: 'Вопрос',
                                    type: 'string',
                                    example: 'Нуждаюсь в трудоустройстве'
                                ),
                                new OA\Property(
                                    property: 'answer',
                                    description: 'Ответ',
                                    type: 'string',
                                    example: "Подать заявление о содействии в поиске подходящей работы, составить резюме можно через личный кабинет Единой цифровой платформы «Работа в России» <a target=\"_blank\" href=\"https://trudvsem.ru/\">https://trudvsem.ru/</a> . \r\nИнструкции и видеоролики  по регистрации, подаче заявления через портал «Работа в России» размещены на интерактивном портале Департамента труда и занятости населения автономного округа в разделе «Гражданам» подраздел «Инструкции для граждан» <a target=\"_blank\" href=\"https://job.admhmao.ru/\">https://job.admhmao.ru/</a>\r\n За помощью в подаче заявления можно обратиться в  МФЦ на территории Югры или посетить центр занятости по предварительной записи по телефону.\r\nНа Единой цифровой платформе «Работа в России» в разделе «Поиск работы» можно самостоятельно искать работу в автономном округе по заданным фильтрам <a target=\"_blank\" href=\"https://trudvsem.ru/vacancy/search?_regionIds=8600000000000&page=0&salary=0&salary=999999\">https://trudvsem.ru/vacancy/search?_regionIds=8600000000000&page=0&salary=0&salary=999999</a>",
                                    format: 'html'
                                ),
                                new OA\Property(
                                    property: 'category_id',
                                    description: 'Идентификатор категории',
                                    type: 'integer',
                                    example: 1
                                ),
                            ]
                        )
                    )
                )
            ]
        );
    }
}
