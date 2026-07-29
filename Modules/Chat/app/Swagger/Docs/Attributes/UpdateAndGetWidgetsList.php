<?php

namespace Modules\Chat\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class UpdateAndGetWidgetsList extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/chat/update_widgets_table",
            operationId: "updateAndGetWidgetsList",
            summary: "(СЕРВИСНЫЙ МЕТОД) Очищает таблицу с виджетами и заполняет её заново основываясь на существующих модулях",
            tags: ['Chat'],
            deprecated: true,
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Successful operation",
                    content: new OA\JsonContent(
                        type: "object",
                        properties: [
                            new OA\Property(
                                property: "id",
                                type: "integer",
                            ),
                            new OA\Property(
                                property: "code_name",
                                type: "string",
                                description: "Системное имя виджета"
                            ),
                            new OA\Property(
                                property: "name",
                                type: "string",
                                description: "Название виджета"
                            ),
                            new OA\Property(
                                property: "description",
                                type: "string",
                                description: "Описание виджета"
                            ),
                            new OA\Property(
                                property: "is_active",
                                type: "boolean",
                                description: "Статус активности виджета"
                            ),
                            new OA\Property(
                                property: "vika_types",
                                type: "array",
                                items: new OA\Items(
                                    type: "object",
                                    properties: [
                                        new OA\Property(
                                            property: "id",
                                            type: "integer"
                                        ),
                                        new OA\Property(
                                            property: "name",
                                            type: "string",
                                            description: "Тип Вики"
                                        ),
                                        new OA\Property(
                                            property: "description",
                                            type: "string",
                                            description: "Описание типа Вики"
                                        ),
                                        new OA\Property(
                                            property: "pivot",
                                            type: "object",
                                            properties: [
                                                new OA\Property(
                                                    property: "widget_id",
                                                    type: "integer",
                                                ),
                                                new OA\Property(
                                                    property: "vika_type_id",
                                                    type: "integer",
                                                )
                                            ]
                                        )
                                    ]
                                )
                            )
                        ]
                    )
                )
            ]
        );
    }
}
