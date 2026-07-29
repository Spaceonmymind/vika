<?php

namespace Modules\RegionHeadHotlineWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class FindPeopleByMax  extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/region_head_hotline/find_people_by_max",
            operationId: "RegionHeadHotlineWidgetFindPeopleByMax",
            summary: "Поиск номера телефона через горячую линию губернатора",
            tags: ['RegionHeadHotlineWidget'],
            requestBody: new OA\RequestBody(
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        required: ['web_app_data','hash','phone'],
                        properties: [
                            new OA\Property(
                                property: 'web_app_data',
                                type: 'string',
                                description: 'Подготовленные данные, полученные из web app для горячей линии губернатора',
                                example: "auth_date=1758887097\nquery_id=..."
                            ),
                            new OA\Property(
                                property: 'hash',
                                type: 'string',
                                description: 'Хеш для проверки подлинности данных',
                                example: '99da5bacf025884dfea08f85886fc1ce7aea469cad255bd24fe3a1ae5cfc7f99'
                            ),
                        ]
                    )
                )
            ),
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Успешная операция поиска номера телефона через горячую линию губернатора",
                    content: new OA\JsonContent(
                        type: "object",
                        properties: [
                            new OA\Property(
                                property: "success",
                                type: "boolean",
                                description: "Успешность поиска номера телефона",
                                example: true
                            ),
                            new OA\Property(
                                property: "phone",
                                type: "string",
                                description: "Найденный номер телефона",
                                example: "79128114517"
                            ),
                            new OA\Property(
                                property: "error",
                                type: "string",
                                description: "Описание ошибки",
                                example: 'Контакт не найден, пожалуйста, сохраните контакт'
                            ),
                        ]
                    )
                )
            ]
        );
    }
}
