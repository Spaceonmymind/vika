<?php

namespace Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class SaveMaxContact  extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/appointment_to_doctor/save_max_contact",
            operationId: "SaveMaxContact",
            summary: "Сохранить контакт пользователя",
            tags: ['AppointmentToDoctorWidget'],
/*            parameters: [
                new OA\Parameter(ref: '#/components/parameters/IdempotencyKeyHeader'),
            ],*/
            requestBody: new OA\RequestBody(
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        required: ['web_app_data','hash','phone'],
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
                            new OA\Property(
                                property: 'phone',
                                type: 'string',
                                description: 'Номер телефона пациента в формате 7123456789',
                                example: '7123456789'
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
                                property: "success",
                                type: "boolean",
                                description: "Успешность сохранения контакта",
                                example: false
                            ),
                            new OA\Property(
                                property: "error",
                                type: "string",
                                description: "Описание ошибки, если сохранение не удалось",
                                example: 'Контакт уже сохранён'
                            ),

                        ]
                    )
                )
            ]
        );
    }
}
