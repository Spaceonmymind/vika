<?php

namespace Modules\Chat\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

use function Symfony\Component\Translation\t;

#[Attribute]
class GetMaxWebAppUrl extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/max/{web_app_url_id}/get_widget",
            operationId: "getMaxWebAppWidget",
            summary: "Получить виджет по web_app_url_id",
            tags: ["MaxController"],
            parameters: [
                new OA\Parameter(
                    name: "web_app_url_id",
                    in: "path",
                    required: true,
                    schema: new OA\Schema(type: "string"),
                    description: "ID web app url"
                )
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Успешная операция",
                    content: new OA\JsonContent(
                        type: "object",
                        properties: [
                            new OA\Property(
                                property: "id",
                                type: "integer",
                                description: "ID записи",
                                example: 2
                            ),
                            new OA\Property(
                                property: "widget_id",
                                type: "integer",
                                nullable: true,
                                description: "ID виджета",
                                example: 10
                            ),
                            new OA\Property(
                                property: "params",
                                type: "object",
                                description: "Параметры запроса",
                                properties: [
                                    new OA\Property(
                                        property: "chat_id",
                                        type: "integer",
                                        description: "ID чата",
                                        example: 16894232
                                    ),
                                    new OA\Property(
                                        property: "from_max",
                                        type: "boolean",
                                        description: "Запрос из MAX",
                                        example: true
                                    )
                                ]
                            ),
                            new OA\Property(
                                property: "chat_widget",
                                type: "object",
                                description: "Данные виджета",
                                nullable: true,
                                properties: [
                                    new OA\Property(
                                        property: "id",
                                        type: "integer",
                                        description: "ID виджета",
                                        example: 10
                                    ),
                                    new OA\Property(
                                        property: "code_name",
                                        type: "string",
                                        description: "Кодовое имя виджета",
                                        example: "vi-social-help"
                                    ),
                                    new OA\Property(
                                        property: "name",
                                        type: "string",
                                        description: "Название виджета",
                                        example: "Меры социальной поддержки"
                                    ),
                                    new OA\Property(
                                        property: "description",
                                        type: "string",
                                        description: "Описание виджета",
                                        example: "Узнать чем может помочь государство"
                                    ),
                                    new OA\Property(
                                        property: "is_active",
                                        type: "boolean",
                                        description: "Активен ли виджет",
                                        example: true
                                    ),
                                    new OA\Property(
                                        property: "type_id",
                                        type: "integer",
                                        description: "ID типа виджета",
                                        example: 1
                                    ),
                                    new OA\Property(
                                        property: "icon_id",
                                        type: "integer",
                                        description: "ID иконки",
                                        example: 7
                                    ),
                                    new OA\Property(
                                        property: "url",
                                        type: "string",
                                        nullable: true,
                                        description: "URL виджета",
                                        example: null
                                    ),
                                    new OA\Property(
                                        property: "bg_colour",
                                        type: "string",
                                        description: "Цвет фона",
                                        example: "#236BD8"
                                    )
                                ]
                            )
                        ]
                    )
                )
            ]
        );
    }
}
