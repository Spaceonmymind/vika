<?php

namespace Modules\Chat\Swagger\Docs\Attributes\AdminWidgetController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetIcons extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/admin/chat/widgets/get_icons",
            operationId: "getIcons",
            summary: "Получить список иконок для виджетов",
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
                    )
                )
            ]
        );
    }
}
