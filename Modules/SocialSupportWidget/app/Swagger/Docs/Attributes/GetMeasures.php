<?php

namespace Modules\SocialSupportWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetMeasures  extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/social_support/get_measures',
            operationId: 'getSocialSupportWidgetMeasures',
            summary: 'Получить список мер поддержки',
            tags: ['SocialSupportWidget'],
            parameters: [
                new OA\Parameter(
                    name: 'situation_id',
                    in: 'query',
                    required: false,
                    description: 'Идентификатор жизненной ситуации',
                    schema: new OA\Schema(
                        type: 'integer',
                        example: 1
                    ),

                ),
                new OA\Parameter(
                    name: 'preferential_categories',
                    in: 'query',
                    required: false,
                    description: 'Льготные категории',
                    schema: new OA\Schema(
                        type: 'array',
                        items: new OA\Items(
                            type: 'integer',
                            example:8
                        )
                    ),
                ),
                new OA\Parameter(
                    name: 'date_relocation',
                    in: 'query',
                    required: false,
                    description: 'Дата переезда в Югру',
                    schema: new OA\Schema(
                        type: 'string',
                        example: '01.01.2025'
                    ),
                ),
                new OA\Parameter(
                    name: 'child_birthday',
                    in: 'query',
                    required: false,
                    description: 'Дата рождения самого младшего ребёнка',
                    schema: new OA\Schema(
                        type: 'string',
                        example: '01.01.2025'
                    ),
                ),
                new OA\Parameter(
                    name: 'income',
                    in: 'query',
                    required: false,
                    description: 'Среднемесячный доход за последние 3 месяца',
                    schema: new OA\Schema(
                        type: 'integer',
                        example: 300
                    ),
                ),
                new OA\Parameter(
                    name: 'family_members_count',
                    in: 'query',
                    required: false,
                    description: 'Количество членов семьи',
                    schema: new OA\Schema(
                        type: 'integer',
                        example: 3
                    ),
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
                                    description: 'Идентификатор Меры поддержки',
                                    type: 'integer',
                                    example: 1
                                ),
                                new OA\Property(
                                    property: 'situation_id',
                                    description: 'Идентификатор ситуации',
                                    type: 'integer',
                                    example: 1
                                ),
                                new OA\Property(
                                    property: 'name',
                                    description: 'Название меры поддержки',
                                    type: 'string',
                                    example: 'Ежемесячная выплата в связи с рождением (усыновлением) первого ребенка'
                                ),
                                new OA\Property(
                                    property: 'conditions',
                                    description: 'Условия получения поддержки',
                                    type: 'string',
                                    example: 'Размер среднедушевого дохода семьи не превышает 2-кратную величину прожиточного минимума трудоспособного населения, установленную в автономном округе за 2 квартал года, предшествующего году обращения за назначением выплаты (в 2021 году - 17 500 руб.)'
                                ),
                                new OA\Property(
                                    property: 'amount_and_deadlines',
                                    description: 'Размер и сроки выплаты поддержки',
                                    type: 'string',
                                    example: 'Выплачивается ежемесячно в размере 18 654 руб. со дня рождения ребенка, если обращение за назначением последовало не позднее шести месяцев со дня рождения ребенка, в остальных случаях  со дня обращения. Выплачивается   до достижения ребенком возраста одного года, двух лет, трех лет.'
                                ),
                                new OA\Property(
                                    property: 'law',
                                    description: 'Правовые основания выплаты',
                                    type: 'string',
                                    example: 'Федеральный закон от 28.12.2017 № 418-ФЗ "О ежемесячных выплатах семьям, имеющим детей", Приказ Минтруда России от 29.12.2017 № 889н "Об утверждении Порядка осуществления ежемесячных выплат в связи с рождением (усыновлением) первого ребенка и (или) второго ребенка, обращения за назначением указанных выплат, а также перечня документов (сведений), необходимых для назначения ежемесячных выплат в связи с рождением (усыновлением) первого и (или) второго ребенка" '
                                ),
                                new OA\Property(
                                    property: 'create_date',
                                    description: 'Дата внесения',
                                    type: 'date',
                                    example: '01.01.2018',
                                    format: 'dd.mm.yyyy'
                                ),
                                new OA\Property(
                                    property: 'update_date',
                                    description: 'Дата внесения изменений',
                                    type: 'date',
                                    example: '23.06.2022',
                                    format: 'dd.mm.yyyy'
                                ),
                                new OA\Property(
                                    property: 'epgu_link',
                                    description: 'Ссылка на госуслуги',
                                    type: 'string',
                                    example: 'https://www.gosuslugi.ru/600165/1/form',
                                ),
                                new OA\Property(
                                    property: 'live_in_ugra_years',
                                    description: 'Срок проживания в Югре(лет)',
                                    type: 'integer',
                                    example: 10,
                                ),
                                new OA\Property(
                                    property: 'max_family_income',
                                    description: 'Максмальный среднедушевой доход семьи',
                                    type: 'integer',
                                    example: 44548,
                                ),
                                new OA\Property(
                                    property: 'max_child_age',
                                    description: 'Максмальный возраст младшего ребёнка',
                                    type: 'integer',
                                    example: 36,
                                ),
                                new OA\Property(
                                    property: 'min_amount',
                                    description: 'Минимальный размер выплаты',
                                    type: 'string',
                                    example: '18 654',
                                ),
                                new OA\Property(
                                    property: 'max_amount',
                                    description: 'Максимальный размер выплаты',
                                    type: 'string',
                                    example: '18 654',
                                ),
                                new OA\Property(
                                    property: 'situation',
                                    description: 'Объект жизненной ситуации',
                                    type: 'object',
                                    properties: [
                                        new OA\Property(
                                            property: 'id',
                                            description: 'Идентификатор жизненной ситуации',
                                            type: 'integer',
                                            example: 1,
                                        ),
                                        new OA\Property(
                                            property: 'name',
                                            description: 'Название жизненной ситуации',
                                            type: 'string',
                                            example: 'Беременность и рождение ребенка',
                                        ),
                                    ]

                                ),
                                new OA\Property(
                                    property: 'preferential_categories',
                                    description: 'Массив льготных категорий',
                                    type: 'array',
                                    items: new OA\Items(
                                        type: 'object',
                                        properties: [
                                            new OA\Property(
                                                property: 'id',
                                                description: 'Идентификатор льготной категории',
                                                type: 'integer',
                                                example: 6,
                                            ),
                                            new OA\Property(
                                                property: 'name',
                                                description: 'Название льготной категории',
                                                type: 'string',
                                                example: 'Лицо из числа КМНС',
                                            ),
                                        ]
                                    )
                                ),

                            ]
                        )
                    )
                )
            ]
        );
    }
}
