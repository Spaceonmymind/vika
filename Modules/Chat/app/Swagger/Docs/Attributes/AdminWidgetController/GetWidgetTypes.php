<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetWidgetTypes extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/admin/chat/widgets/get_types",
            operationId: "getWidgetTypes",
            summary: "Получить список типов виджетов",
            tags: ["AdminWidgetController",'AdminVikaTypeController'],
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
                                    description: "ID типа виджета",
                                    example: 1
                                ),
                                new OA\Property(
                                    property: "code",
                                    type: "string",
                                    description: "Код типа виджета",
                                    example: "internal"
                                ),
                                new OA\Property(
                                    property: "name",
                                    type: "string",
                                    description: "Название типа виджета",
                                    example: "Внутренний"
                                )
                            ]
                        )
                    )
                )
            ]
        );
    }
}
