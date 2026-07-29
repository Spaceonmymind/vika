<?php

namespace Modules\Chat\Swagger\Docs\Attributes\MaxController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class SendAppointmentNotificationToMax extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/max/send_notification",
            operationId: "SendAppointmentNotificationToMax",
            summary: "Отправить уведомление пользователю в MAX",
            tags: ["MaxController"],
            parameters: [
                new OA\Parameter(
                    name: "phone",
                    in: 'query',
                    required: true,
                    schema: new OA\Schema(type: "string"),
                ),
                new OA\Parameter(
                    name: "message",
                    in: 'query',
                    required: true,
                    schema: new OA\Schema(type: "string"),
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Успешная операция",
                    content: new OA\JsonContent(
                        type: "object",
                        properties: [
                            new OA\Property(
                                property: "success",
                                type: "boolean",
                            ),
                            new OA\Property(
                                property: "is_message_sent",
                                type: "boolean",
                                description: "Было ли сообщение успешно отправлено в MAX. (Если не подписан на уведомления, то false)",
                            ),
                        ]
                    )
                )
            ]
        );
    }
}
