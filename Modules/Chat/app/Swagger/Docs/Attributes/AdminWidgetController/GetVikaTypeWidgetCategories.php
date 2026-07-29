<?php
namespace Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetVikaTypeWidgetCategories extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/admin/chat/vika_types/{vika_type}/get_widget_categories",
            operationId: "getVikaTypeWidgetCategories",
            summary: "Получить категории виджетов для типа Вики",
            tags: ["AdminWidgetController"],
            parameters: [
                new OA\Parameter(
                    name: "vika_type",
                    in: "path",
                    required: true,
                    schema: new OA\Schema(type: "integer"),
                    description: "ID типа Вики"
                )
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Успешная операция",
                    content: new OA\JsonContent(
                        type: "array",
                        items: new OA\Items(
                            type: "object",
                            properties: [
                                new OA\Property(
                                    property: "id",
                                    type: "integer",
                                    description: "ID категории виджетов",
                                    example: 3
                                ),
                                new OA\Property(
                                    property: "name",
                                    type: "string",
                                    description: "Название категории",
                                    example: "Меры поддержки"
                                ),
                                new OA\Property(
                                    property: "description",
                                    type: "string",
                                    description: "Описание категории",
                                    example: "Узнать о мерах поддержки, оказываемых разным категориям граждан"
                                ),
                                new OA\Property(
                                    property: "icon_id",
                                    type: "integer",
                                    nullable: true,
                                    description: "ID иконки",
                                    example: 1
                                ),
                                new OA\Property(
                                    property: "vika_type_id",
                                    type: "integer",
                                    description: "ID типа Вики",
                                    example: 5
                                ),
                                new OA\Property(
                                    property: "order",
                                    type: "integer",
                                    description: "Порядок отображения категории",
                                    example: 500
                                ),
                                new OA\Property(
                                    property: "bg_colour",
                                    type: "string",
                                    nullable: true,
                                    description: "Цвет фона категории",
                                    example: "#000000"
                                ),
                                new OA\Property(
                                    property: "icon",
                                    type: "object",
                                    nullable: true,
                                    description: "Иконка категории",
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
                                )
                            ]
                        )
                    )
                )
            ]
        );
    }
}
