<?php

namespace Modules\Chat\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetWidgetInfoByCode extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/chat/widget/{widget_code}/get_by_code",
            operationId: "getWidgetInfoByCode",
            tags: ["Chat"],
            summary: "Получить информацию о виджете по code_name",
            parameters: [
                new OA\Parameter(
                    name: "widget_code",
                    in: "path",
                    required: true,
                    description: "Кодовое имя (code_name) виджета",
                    schema: new OA\Schema(
                        type: "string",
                        example: 'vi-business-help'
                    )
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
                                description: "ID виджета",
                                example: 4
                            ),
                            new OA\Property(
                                property: "code_name",
                                type: "string",
                                description: "Кодовое имя виджета",
                                example: "vi-business-help"
                            ),
                            new OA\Property(
                                property: "name",
                                type: "string",
                                description: "Название виджета",
                                example: "Меры поддержки предпринимателей"
                            ),
                            new OA\Property(
                                property: "description",
                                type: "string",
                                description: "Описание виджета",
                                example: "Узнать чем может помочь государство предпринимателю"
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
                                example: 1
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
                                nullable: true,
                                description: "Цвет фона виджета",
                                example: '#61affe'
                            ),
                            new OA\Property(
                                property: "icon",
                                type: "object",
                                description: "Иконка виджета",
                                properties: [
                                    new OA\Property(
                                        property: "id",
                                        type: "integer",
                                        description: "ID иконки",
                                        example: 1
                                    ),
                                    new OA\Property(
                                        property: "code",
                                        type: "string",
                                        description: "Код иконки",
                                        example: "support-measures"
                                    ),
                                    new OA\Property(
                                        property: "name",
                                        type: "string",
                                        description: "Название иконки",
                                        example: "Вопрос"
                                    )
                                ]
                            ),
                            new OA\Property(
                                property: "type",
                                type: "object",
                                description: "Тип виджета",
                                properties: [
                                    new OA\Property(
                                        property: "id",
                                        type: "integer",
                                        description: "ID типа",
                                        example: 1
                                    ),
                                    new OA\Property(
                                        property: "code",
                                        type: "string",
                                        description: "Код типа",
                                        example: "internal"
                                    ),
                                    new OA\Property(
                                        property: "name",
                                        type: "string",
                                        description: "Название типа",
                                        example: "Внутренний"
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
