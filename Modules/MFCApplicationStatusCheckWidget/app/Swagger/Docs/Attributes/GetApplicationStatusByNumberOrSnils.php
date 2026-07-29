<?php

namespace Modules\MFCApplicationStatusCheckWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetApplicationStatusByNumberOrSnils  extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/mfc_application_status/get_application_status',
            operationId: 'getApplicationStatusByNumberOrSnils',
            summary: 'Получить статус дела по номеру дела или СНИЛСу',
            tags: ['MFCApplicationStatusCheckWidget'],
            parameters: [
                new OA\Parameter(
                    name: 'number',
                    in: 'query',
                    description: 'Номер дела или снилс',
                    required: true,
                    example:'999-999-999 99'
                )
            ],
            responses: [
                new OA\Response(
                    response: '200-snils',
                    description: 'Статус дела по СНИЛС',
                    content: new OA\JsonContent(
                        type: 'object',
                            properties: [
                                new OA\Property(
                                    property: 'is_snils',
                                    description: 'Был ли найден снилс в запросе',
                                    type: 'boolean',
                                    example: true
                                ),
                                new OA\Property(
                                    property: 'found_applications',
                                    description: 'Найденные дела',
                                    type: 'array',
                                    items: new OA\Items(
                                        type: 'object',
                                        properties: [
                                            new OA\Property(
                                                property: 'created_date',
                                                description: 'Дата создания дела',
                                                type: 'string',
                                                format: 'date:Y-m-d',
                                                example: '2025-03-18'
                                            ),
                                            new OA\Property(
                                                property: 'status_text',
                                                description: 'Статус дела',
                                                type: 'string',
                                                example: 'Передано в Ведомство'
                                            ),
                                            new OA\Property(
                                                property: 'mfc_address',
                                                description: 'Адрес отделения мфц',
                                                type: 'string',
                                                example: '628418, Ханты-Мансийский Автономный округ - Югра АО, Сургут г, Профсоюзов ул, дом 11'
                                            ),
                                            new OA\Property(
                                                property: 'service_name',
                                                description: 'Наименование услуги',
                                                type: 'string',
                                                example: 'Предоставление социальной поддержки отдельным категориям граждан в соответствии с принятыми нормативными актами Ханты-Мансийского автономного округа - Югры'
                                            ),
                                            new OA\Property(
                                                property: 'reg_num',
                                                description: 'Номер дела',
                                                type: 'string',
                                                example: '20250318-011_1-87'
                                            ),
                                        ]
                                    )
                                ),
                            ]
                        )
                ),
                new OA\Response(
                    response: '200-case-number',
                    description: 'Статус дела по номеру дела',
                    content: new OA\JsonContent(
                        type: 'object',
                        properties: [
                            new OA\Property(
                                property: 'is_snils',
                                description: 'Был ли найден снилс в запросе',
                                type: 'boolean',
                                example: false
                            ),
                            new OA\Property(
                                property: 'found_applications',
                                description: 'Найденные дела',
                                type: 'array',
                                items: new OA\Items(
                                    type: 'object',
                                    properties: [
                                        new OA\Property(
                                            property: 'status_text',
                                            description: 'Статус дела',
                                            type: 'string',
                                            example: 'Передано в Ведомство'
                                        ),
                                        new OA\Property(
                                            property: 'result_text',
                                            description: 'Результат оказания услуги',
                                            type: 'string',
                                            example: 'Результат оказания услуги не известен'
                                        ),
                                        new OA\Property(
                                            property: 'mfc_address',
                                            description: 'Адрес отделения мфц',
                                            type: 'string',
                                            example: '628418, Ханты-Мансийский Автономный округ - Югра АО, Сургут г, Профсоюзов ул, дом 11'
                                        ),
                                        new OA\Property(
                                            property: 'service_name',
                                            description: 'Наименование услуги',
                                            type: 'string',
                                            example: 'Предоставление социальной поддержки отдельным категориям граждан в соответствии с принятыми нормативными актами Ханты-Мансийского автономного округа - Югры'
                                        ),
                                        new OA\Property(
                                            property: 'reg_num',
                                            description: 'Номер дела',
                                            type: 'string',
                                            example: '20250318-011_1-87'
                                        ),
                                    ]
                                )
                            ),
                        ]
                    )
                )
            ]
        );
    }
}
