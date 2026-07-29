<?php

namespace Modules\BusinessSupportWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetSupportMeasures extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/business_support/get_measures",
            operationId: "getBusinessSupportWidgetSupportMeasures",
            summary: "Возвращает список мер поддержки предпринимателей",
            tags: ['BusinessSupportWidget'],
            parameters: [
                new OA\Parameter(
                    name: 'situation_id',
                    in: 'query',
                    required: false,
                    description: 'Идентификатор жизненной ситуации',
                    schema: new OA\Schema(
                        type: 'integer',
                    ),
                    example: 1,
                ),
                new OA\Parameter(
                    name: 'registration_place_id',
                    in: 'query',
                    required: false,
                    description: 'Идентификатор места регистрации заявителя',
                    schema: new OA\Schema(
                        type: 'integer',
                    ),
                    example: 1,
                ),
                new OA\Parameter(
                    name: 'subject_id',
                    in: 'query',
                    required: false,
                    description: 'Идентификатор получателя поддержки',
                    schema: new OA\Schema(
                        type: 'integer',
                    ),
                    example: 1,
                ),
                new OA\Parameter(
                    name: 'support_organisation_id',
                    in: 'query',
                    required: false,
                    description: 'Идентификатор организации, предоставляющей меру поддержки',
                    schema: new OA\Schema(
                        type: 'integer',
                    ),
                    example: 1,
                ),
                new OA\Parameter(
                    name: 'support_type_id',
                    in: 'query',
                    required: false,
                    description: 'Идентификатор типа поддержки',
                    schema: new OA\Schema(
                        type: 'integer',
                    ),
                    example: 1,
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Successful operation",
                    content: new OA\JsonContent(
                        type: "object",
                        allOf: [
                            new OA\Property(ref: '#/components/schemas/CursorPaginator'),
                            new OA\Schema(
                                properties: [
                                    new OA\Property(
                                        property: 'data',
                                        description: 'Список сообщений чата',
                                        type: 'array',
                                        items: new OA\Items(
                                            type: 'object',
                                            properties: [
                                                new OA\Property(
                                                    property: 'id',
                                                    type: 'integer',
                                                    description: 'Уникальный идентификатор меры поддержки',
                                                    example: 1,
                                                ),
                                                new OA\Property(
                                                    property: 'name',
                                                    type: 'string',
                                                    description: 'Название меры поддержки',
                                                    example: 'Финансовая поддержка в рамках реализации регионального проекта «Акселерация субъектов малого и среднего предпринимательства», осуществляющим социально значимые (приоритетные) виды деятельности в соответствии с перечнем, утвержденным муниципальным правовым актом администрации Березовского района (по ОКВЭД), по возмещению части затрат на аренду (субаренду)  нежилых помещений',
                                                ),
                                                new OA\Property(
                                                    property: 'description',
                                                    type: 'string',
                                                    description: 'Описание меры поддержки',
                                                    example: 'Муниципальная программа "Развитие экономического потенциала Березовского района"',
                                                ),
                                                new OA\Property(
                                                    property: 'conditions',
                                                    type: 'string',
                                                    description: 'Условия получения меры поддержки',
                                                    example: 'К возмещению принимаются затраты, произведенные получателем субсидии по основному виду деятельности, указанному в заявлении о предоставлении субсидии и содержащемуся в выписке из Единого государственного реестра юридических лиц, Единого государственного реестра индивидуальных предпринимателей. В расчет субсидии включаются фактически осуществленные и документально подтвержденные затраты, произведенных участниками отбора, в течение 12 (двенадцати) месяцев, предшествующих дате регистрации заявления о предоставлении субсидии. Условием предоставления субсидии Субъектам по региональному проекту «Акселерация субъектов малого и среднего предпринимательства» является неполучение аналогичной поддержки по региональному проекту «Создание условий для легкого старта и комфортного ведения бизнеса».',
                                                ),
                                                new OA\Property(
                                                    property: 'activities',
                                                    type: 'string',
                                                    description: 'Виды деятельности организации',
                                                    example: 'По видам экономической деятельности в соответствии с утвержденным муниципальным правовым актом администрации Березовского района (постановление администрации Березовского райна от 02.08.2021 № 889 "О Перечне социально-значимых (приритетных) видах деятельности, осуществляемых субъектами малого и среднего предпринимательства")'
                                                ),
                                                new OA\Property(
                                                    property: 'financial_support',
                                                    type: 'string',
                                                    description: 'Размер выплаты',
                                                    example: 'Размер субсидии составляет 50% от общего объема затрат и не более 300 тыс. рублей на 1 получателя субсидии в год'
                                                ),
                                                new OA\Property(
                                                    property: 'terms',
                                                    type: 'string',
                                                    description: 'Сроки выплаты',
                                                    example: 'Решение о предоставлении субсидии (об отказе в предоставлении субсидии) принимается Главным распорядителем бюджетных средств в виде муниципального правового акта о предоставлении субсидии (об отказе в предоставлении субсидии) в срок не позднее 30 (тридцати) календарных дней от даты окончания приема предложений (заявлений) участников отбора, указанной в объявлении о проведении отбора (за исключением абзаца пятого подпункта 2.5.2 Порядка). В случае, предусмотренном абзацем пятым подпункта 2.5.2 Порядка, срок принятия решения о предоставлении субсидии (об отказе в предоставлении субсидии) продлевается и не может составлять более 40 (сорок) календарных дней от даты окончания приема предложений (заявлений) участников отбора, указанной в объявлении о проведении отбора. Перечисление субсидии получателю субсидии осуществляется на основании заключенного соглашения. Субсидия перечисляется не позднее 10 (десятого) рабочего со дня подписания Распоряжения на расчетный или корреспондентский счет, открытый получателем субсидии в кредитной организации.'
                                                ),
                                                new OA\Property(
                                                    property: 'law',
                                                    type: 'string',
                                                    description: 'Правовые основания',
                                                    example: 'Федеральный закон от 24.07.2007 N 209-ФЗ ""О развитии малого и среднего предпринимательства в Российской Федерации"" Закон Ханты-Мансийского автономного округа - Югры от 29 декабря 2007 года №213-оз «О развитии малого и среднего предпринимательства в ХантыМансийском автономном округе – Югре» ПОЛОЖЕНИЕо сотрудничестве Фонда поддержки предпринимательства Югры сфинансовыми организациями и предоставлении поручительства пообязательствам субъектов малого и среднего предпринимательства,организаций, образующих инфраструктуру поддержки субъектовмалого и среднего предпринимательства, утвержденное решением Наблюдательного советаФонда поддержки предпринимательства Югры от «28» декабря 2018 года'
                                                ),
                                                new OA\Property(
                                                    property: 'revenue_year',
                                                    type: 'string',
                                                    description: 'Выручка на конец года',
                                                    example: 'Максимально допустимая сумма годовой выручки без НДС за предыдущий год Микропредприятие - 120 млн рублей; Малое предприятие - 800 млн рублей; Среднее предприятие - 2 млрд рублей.'
                                                ),
                                                new OA\Property(
                                                    property: 'company_age',
                                                    type: 'string',
                                                    description: 'Возраст компании',
                                                    example: 'впервые зарегистрированные и действующие менее 1 года индивидуальные предприниматели и юридические лица на дату обращения'
                                                ),
                                                new OA\Property(
                                                    property: 'documents',
                                                    type: 'string',
                                                    description: 'Набор необходимых документов',
                                                    example: 'Завление о предоставлении субсидии, заявление о соответствии вновь созданного ЮЛ или вновь зарегистрированного ИП условиям отнесения к субъектам установленным 209-ФЗ, участники отбора-индивидуальные предприниматели предоставляют копию документа, удостоверяющего личность участника отбора, участники отбора-юридические лица предоставляют документ, подтверждающий полномочия лица на осуществление действий от имени организации (решение о назначении или об избрании либо приказ о назначении физического лица на должность, в соответствии с которыми такое физическое лицо обладает правом действовать от имени организации без доверенности (далее-руководитель), документы, подтверждающие возникновение затрат, в том числе: копии договоров, с приложениями указанными в договорах, первичные учетные документы (счета, счета-фактуры, акты сдачи-приемки выполненных работ (оказанных услуг), товарные накладные, технические характеристики (паспорта), акты сверок), копии документов, подтверждающих оплату выполненных работ (предоставленных услуг), приобретение товара, опись документов, предоставляемых для получения субсидии, согласие на обработку персональных данных (для индивидуальных предпринимателей).'
                                                ),
                                                new OA\Property(
                                                    property: 'date_receipt_documents',
                                                    type: 'string',
                                                    description: 'Дата приёма документов',
                                                    example: 'В целях проведения отбора Комитет размещает на едином портале и официальном сайте Главного распорядителя бюджетных средств в информационно-телекоммуникационной сети «Интернет» (https://www.berezovo.ru/) объявление о проведении отбора с указанием: сроков проведения отбора, даты начала подачи или окончания приема предложений (заявлений) участников отбора, которая не может быть ранее 10-го календарного дня, следующего за днем размещения объявления о проведении отбора.'
                                                ),
                                                new OA\Property(
                                                    property: 'employees',
                                                    type: 'string',
                                                    description: 'Количество сотрудников организации',
                                                    example: null
                                                ),
                                                new OA\Property(
                                                    property: 'contacts',
                                                    type: 'string',
                                                    description: 'Контакты',
                                                    example: 'Заведующий отделом предпринимательства и потребительского рынка комитета по экономической политике администрации Березовского района Крылова Виктория Васильевна +73467421565'
                                                ),
                                                new OA\Property(
                                                    property: 'situation_id',
                                                    type: 'integer',
                                                    description: 'Идентификатор жизненной ситуации',
                                                    example: 1
                                                ),
                                                new OA\Property(
                                                    property: 'subject_id',
                                                    type: 'integer',
                                                    description: 'Идентификатор получателя поддержки',
                                                    example: 1
                                                ),
                                                new OA\Property(
                                                    property: 'registration_place_id',
                                                    type: 'integer',
                                                    description: 'Идентификатор места регистрации',
                                                    example: 1
                                                ),
                                                new OA\Property(
                                                    property: 'support_organisation_id',
                                                    type: 'integer',
                                                    description: 'Идентификатор организации, предоставляющей меру поддержки',
                                                    example: 1
                                                ),
                                                new OA\Property(
                                                    property: 'support_type_id',
                                                    type: 'integer',
                                                    description: 'Идентификатор типа поддержки',
                                                    example: 1
                                                ),
                                                new OA\Property(
                                                    property: 'business_support_widget_registration_place',
                                                    type: 'object',
                                                    ref: '#/components/schemas/BusinessSupportRegistrationPlace'
                                                ),
                                                new OA\Property(
                                                    property: 'business_support_widget_situation',
                                                    type: 'object',
                                                    ref: '#/components/schemas/BusinessSupportSituation'
                                                ),
                                                new OA\Property(
                                                    property: 'business_support_widget_subject',
                                                    type: 'object',
                                                    ref: '#/components/schemas/BusinessSupportSubject'
                                                ),
                                                new OA\Property(
                                                    property: 'business_support_widget_support_organisation',
                                                    type: 'object',
                                                    ref: '#/components/schemas/BusinessSupportSupportOrganisation'
                                                ),
                                                new OA\Property(
                                                    property: 'business_support_widget_support_type',
                                                    type: 'object',
                                                    ref: '#/components/schemas/BusinessSupportSupportType'
                                                ),
                                            ],
                                        ),

                                    ),
                                ],
                            ),
                        ],
                    ),
                ),
            ],
        );
    }
}
