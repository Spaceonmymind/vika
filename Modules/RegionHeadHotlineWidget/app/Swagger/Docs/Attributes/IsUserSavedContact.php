<?php

namespace Modules\RegionHeadHotlineWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class IsUserSavedContact  extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/region_head_hotline/is_user_saved_contact",
            operationId: "RegionHeadHotlineWidgetisUserSavedContact",
            summary: "Проверить, сохранен ли контакт пользователя из MAX для горячей линии",
            tags: ['RegionHeadHotlineWidget'],
            requestBody: new OA\RequestBody(
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        required: ['web_app_data','hash'],
                        properties: [
                            new OA\Property(
                                property: 'web_app_data',
                                type: 'string',
                                description: 'Подготовленные данные, полученные из web app',
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
                    description: "Successful operation",
                    content: new OA\JsonContent(
                        type: "object",
                        properties: [
                            new OA\Property(
                                property: "has_contact",
                                type: "boolean",
                                description: "Расшарил ли пользователь свой контакт",
                                example: true
                            )
                        ]
                    )
                )
            ]
        );
    }
}
