<?php

namespace Modules\RegionHeadHotlineWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class CreateAppeal extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/region_head_hotline/create_appeal",
            operationId: "RegionHeadHotlineWidgetCreateAppeal",
            summary: "Создание обращения через горячую линию губернатора",
            tags: ['RegionHeadHotlineWidget'],
            parameters: [
                new OA\Parameter(ref: '#/components/parameters/IdempotencyKeyHeader'),
            ],
            requestBody: new OA\RequestBody(
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        required: ['web_app_data', 'hash', 'appeal'],
                        properties: [
                            new OA\Property(
                                property: 'web_app_data',
                                type: 'string',
                                description: 'Данные web app для горячей линии губернатора',
                                example: "auth_date=1758887097\nquery_id=..."
                            ),
                            new OA\Property(
                                property: 'hash',
                                type: 'string',
                                description: 'Хеш для проверки подлинности данных',
                                example: 'fb3715a8ab3310ee358454557e150084a8b859ae1e7a9d1fa214d2cf1ec7c29b'
                            ),
                            new OA\Property(
                                property: 'appeal',
                                type: 'object',
                                required: ['fio', 'address', 'email', 'complaint'],
                                properties: [
                                    new OA\Property(
                                        property: 'fio',
                                        type: 'string',
                                        description: 'ФИО заявителя',
                                        example: 'Ивано Иван Иванович'
                                    ),
                                    new OA\Property(
                                        property: 'address',
                                        type: 'string',
                                        description: 'Адрес заявителя',
                                        example: 'Ханты-мансийск шевченко 19'
                                    ),
                                    new OA\Property(
                                        property: 'email',
                                        type: 'string',
                                        description: 'Email заявителя',
                                        example: 'egor01998@rambler.ru'
                                    ),
                                    new OA\Property(
                                        property: 'complaint',
                                        type: 'string',
                                        description: 'Текст жалобы',
                                        example: 'очень плохо чистят снег'
                                    ),
                                ]
                            ),
                        ]
                    )
                )
            ),
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Успешное создание обращения или ошибка с указанием нецензурных выражений",
                    content: new OA\JsonContent(
                        oneOf: [
                            new OA\Schema(
                                type: "object",
                                properties: [
                                    new OA\Property(
                                        property: "success",
                                        type: "boolean",
                                        example: true,
                                        description: "Флаг успешного создания обращения"
                                    ),
                                ]
                            ),
                            new OA\Schema(
                                type: "object",
                                properties: [
                                    new OA\Property(
                                        property: "success",
                                        type: "boolean",
                                        example: false,
                                        description: "Успешность создания обращения"
                                    ),
                                    new OA\Property(
                                        property: "error",
                                        type: "string",
                                        example: "В обращении обнаружены нецензурные выражения: хуй",
                                        description: "Описание ошибки, если найдены нецензурные выражения"
                                    ),
                                ]
                            ),
                        ]
                    )
                )
            ]
        );
    }
}
