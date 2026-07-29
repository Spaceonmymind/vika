<?php

namespace Modules\PfrHelpWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetQuestions extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/pfr_help/get_questions',
            operationId: 'getPfrHelpWidgetQuestions',
            summary: 'Получить список вопросов с ответами',
            tags: ['PfrHelpWidget'],
            parameters: [
                new OA\Parameter(
                    name: 'category_id',
                    description: 'Идентификатор категории',
                    required: false,
                    in: 'query',
                    example: 1,
                ),
                new OA\Parameter(
                    name: 'service_id',
                    description: 'Идентификатор услуги',
                    required: false,
                    in: 'query',
                    example: 1,
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
                                    example: 1,
                                ),
                                new OA\Property(
                                    property: 'question',
                                    description: 'Непосредственно вопрос',
                                    type: 'string',
                                    example: 'Как подать заявление?',
                                ),
                                new OA\Property(
                                    property: 'answer',
                                    description: 'Ответ на вопрос',
                                    type: 'string',
                                    example: "Заявление можно подать:\r\n<ul><li>- через портал Госуслуг по ссылке   <a href=\"https://www.gosuslugi.ru/10626/1/\">https://www.gosuslugi.ru/10626/1/</a></li>\r\n<li>- в МФЦ</li>\r\n<li>- в клиентской службе Пенсионного фонда России по месту жительства, адреса ОПФР по ХМАО – Югре смотрите здесь <a href=\"https://pfr.gov.ru/branches/hmao/info/~0/6995\">https://pfr.gov.ru/branches/hmao/info/~0/6995</a></li>\r\n\r\nПодать нужно только заявление. Пенсионный фонд самостоятельно запросит необходимые документы в рамках межведомственного взаимодействия из соответствующих органов и организаций.\r\n\r\nПредставить дополнительные сведения о доходах понадобится только в том случае, если в семье есть военные, спасатели, полицейские или служащие другого силового ведомства, а также, если кто-то получает стипендии, гранты и другие выплаты научного или учебного заведения.\r\nРассмотрят заявление в течение 10 рабочих дней. В отдельных случаях максимальный срок составит 30 рабочих дней.   \r\n",
                                    format: 'html',
                                ),
                                new OA\Property(
                                    property: 'category_id',
                                    description: 'Идентификатор категории',
                                    type: 'integer',
                                    example: 1,
                                ),

                            ],
                        ),
                    ),
                ),
            ],
        );
    }
}
