<?php

namespace Modules\ITSupportWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetMeasures extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/it_support/get_measures",
            operationId: "getITSupportWidgetMeasures",
            summary: "Возвращает список мер поддержки it",
            tags: ['ITSupportWidget'],
            parameters: [
                new OA\Parameter(
                    name: 'name',
                    in: 'query',
                    required: false,
                    description: 'Наименование меры поддержки',
                    schema: new OA\Schema(
                        type: 'string',
                    ),
                    example: 'усн',
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
                                    description: 'Идентификатор меры поддержки',
                                    type: 'integer',
                                    example: 14
                                ),
                                new OA\Property(
                                    property: 'name',
                                    description: 'Наименование меры поддержки',
                                    type: 'string',
                                    example: 'Налоговая ставка в размере 5% при применении УСН с объектом налогообложения доходы'
                                ),
                                new OA\Property(
                                    property: 'type',
                                    description: 'Тип меры поддержки',
                                    type: 'string',
                                    example: 'Региональная мера'
                                ),
                                new OA\Property(
                                    property: 'conditions',
                                    description: 'Условия получения',
                                    type: 'string',
                                    example: "Пониженная налоговая ставка, применяется организациями и индивидуальными предпринимателями, применяющим упрощенную систему налогообложения, и соответствующими условию, что в общем объеме доходов от реализации товаров (работ, услуг) налогоплательщика, определяемом в соответствии со статьей 346.15 Налогового кодекса Российской Федерации, не менее 70% составляет объем дохода от реализации товаров (работ, услуг) при осуществлении следующих видом экономической деятельности:\nдеятельность в области телевизионного и радиовещания (класс 60);\nдеятельность в сфере телекоммуникаций (класс 61);\nразработка компьютерного программного обеспечения, консультационные услуги в данной области и другие сопутствующие услуги (класс 62);\nдеятельность в области информационных технологий (класс 63).\nУслуга носит заявительный характер, применяется к правоотношениям, возникшим с 1 января 2009 года.\nОснование: Закон ХМАО - Югры от 30.12.2008 № 166-оз «О ставках налога, уплачиваемого в связи с применением упрощенной системы налогообложения»."
                                ),
                                new OA\Property(
                                    property: 'terms',
                                    description: 'Сроки оказания поддержки',
                                    type: 'string',
                                    example: 'по 31 декабря 2027 года'
                                ),
                                new OA\Property(
                                    property: 'responsible',
                                    description: 'Ответственный',
                                    type: 'string',
                                    example: 'Управление Федеральной налоговой службы Российской Федерации по Ханты-Мансийскому автономному округу - Югре'
                                ),

                            ]
                        )
                    )
                ),
            ],
        );
    }
}
