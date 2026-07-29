<?php

namespace Modules\KMNSSupportWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetMeasures extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/kmns_support/get_measures",
            operationId: "getKMNSSupportWidgetMeasures",
            summary: "Возвращает список мер поддержки КМНС",
            tags: ['KMNSSupportWidget'],
            parameters: [
                new OA\Parameter(
                    name: 'name',
                    in: 'query',
                    required: false,
                    description: 'Наименование меры поддержки',
                    schema: new OA\Schema(
                        type: 'string',
                    ),
                    example: 'Выдача',
                ),
                new OA\Parameter(
                    name: 'activity_type_id',
                    in: 'query',
                    required: false,
                    description: 'Идентификатор сферы жизнедеятельности',
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
                                    description: 'Идентификатор меры поддержки',
                                    type: 'integer',
                                    example: 1
                                ),
                                new OA\Property(
                                    property: 'name',
                                    description: 'Наименование меры поддержки',
                                    type: 'string',
                                    example: 'Выдача документированной информации из государственного охотхозяйственного реестра Ханты-Мансийского автономного округа Югры'
                                ),
                                new OA\Property(
                                    property: 'support_organisation',
                                    description: 'Организация, оказывающая услугу',
                                    type: 'string',
                                    example: 'Департамент недропользования и природных ресурсов Ханты-Мансийского автономного округа – Югры'
                                ),
                                new OA\Property(
                                    property: 'subject',
                                    description: 'Получатель услуги',
                                    type: 'string',
                                    example: 'Юридические лица, Индивидуальные предприниматели, Граждане РФ'
                                ),
                                new OA\Property(
                                    property: 'terms',
                                    description: 'Сроки оказания услуги',
                                    type: 'string',
                                    example: '30 дней'
                                ),
                                new OA\Property(
                                    property: 'apply_types',
                                    description: 'Способы подачи',
                                    type: 'string',
                                    example: 'Лично, Через законного представителя, Почтой, По e-mail, На WEB сайте, Через ЕПГУ'
                                ),
                                new OA\Property(
                                    property: 'get_result_types',
                                    description: 'Способы получения результата',
                                    type: 'string',
                                    example: 'Лично, Почтой, По e-mail, На WEB сайте'
                                ),
                                new OA\Property(
                                    property: 'measure_result',
                                    description: 'Результат оказания услуги',
                                    type: 'string',
                                    example: 'Документированная информация в виде выписки из государственного охотхозяйственного реестра Ханты-Мансийского автономного округа – Югры'
                                ),
                                new OA\Property(
                                    property: 'documents',
                                    description: 'учреждение юридического лица , постановка на налоговый учет , государственная регистрация индивидуального предпринимателя , право действовать от имени юридического лица , удостоверение личности гражданина РФ , постановка индивидуального предпринимателя на налоговый учет , государственная регистрация юридического лица',
                                    type: 'string',
                                    example: 'Документированная информация в виде выписки из государственного охотхозяйственного реестра Ханты-Мансийского автономного округа – Югры'
                                ),
                                new OA\Property(
                                    property: 'link',
                                    description: 'Ссылка на получение услуги',
                                    type: 'string',
                                    example: 'https://www.gosuslugi.ru/47855/1/info'
                                ),
                                new OA\Property(
                                    property: 'activity_type_id',
                                    description: 'Идентификатор сферы жизнедеятельности',
                                    type: 'integer',
                                    example: 2
                                ),
                                new OA\Property(
                                    property: 'activity_type',
                                    description: 'Сфера жизнедеятельности',
                                    type: 'object',
                                    properties: [
                                        new OA\Property(
                                            property: 'id',
                                            description: 'Идентификатор сферы жизнедеятельности',
                                            type: 'integer',
                                            example: 2
                                        ),
                                        new OA\Property(
                                            property: 'name',
                                            description: 'Наименование сферы жизнедеятельности',
                                            type: 'string',
                                            example: 'Традиционная хозяйственная деятельность'
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
