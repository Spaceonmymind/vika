<?php

namespace Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetDoctorFreeSlots extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/appointment_to_doctor/get_doctor_free_slots",
            operationId: "GetDoctorFreeSlots",
            summary: "Получение свободных слотов у конкретного врача для записи",
            tags: ['AppointmentToDoctorWidget'],
            requestBody: new OA\RequestBody(
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        required: ['web_app_data','hash','post_id','med_organisation_guid','doctor_id'],
                        properties: [
                            new OA\Property(
                                property: 'web_app_data',
                                type: 'string',
                                description: 'Подготовленные данные, полученные из web app',
                                example: "auth_date=1759217700\nquery_id=..."
                            ),
                            new OA\Property(
                                property: 'hash',
                                type: 'string',
                                description: 'Хеш для проверки подлинности данных',
                                example: 'fb3715a8ab3310ee358454557e150084a8b859ae1e7a9d1fa214d2cf1ec7c29b'
                            ),
                            new OA\Property(
                                property: 'post_id',
                                type: 'string',
                                description: 'ID специальности врача',
                                example: '54'
                            ),
                            new OA\Property(
                                property: 'med_organisation_guid',
                                type: 'string',
                                description: 'GUID выбранной медицинской организации',
                                example: 'b64cc6f4-4a81-48d8-4004-ef756af86d6f'
                            ),
                            new OA\Property(
                                property: 'doctor_id',
                                type: 'string',
                                description: 'ID врача',
                                example: '0cb82341-02f4-4026-3727-cd189b615801'
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
                                description: "Успешность получения слотов",
                                example: true
                            ),
                            new OA\Property(
                                property: "free_slots",
                                type: "array",
                                description: "Список свободных слотов по датам",
                                items: new OA\Items(
                                    properties: [
                                        new OA\Property(
                                            property: "date",
                                            type: "string",
                                            description: "Дата",
                                            example: "01.10.2025"
                                        ),
                                        new OA\Property(
                                            property: "slots",
                                            type: "array",
                                            description: "Список слотов на дату",
                                            items: new OA\Items(
                                                properties: [
                                                    new OA\Property(
                                                        property: "id",
                                                        type: "string",
                                                        description: "ID слота",
                                                        example: "5d87f8ae-50ca-4722-743e-3017f5e09ff8"
                                                    ),
                                                    new OA\Property(
                                                        property: "date",
                                                        type: "string",
                                                        description: "Дата слота",
                                                        example: "01.10.2025"
                                                    ),
                                                    new OA\Property(
                                                        property: "time",
                                                        type: "string",
                                                        description: "Время слота",
                                                        example: "11:31"
                                                    ),
                                                    new OA\Property(
                                                        property: "duration",
                                                        type: "integer",
                                                        description: "Длительность слота (минуты)",
                                                        example: 10
                                                    ),
                                                ]
                                            )
                                        ),
                                    ]
                                )
                            ),
                            new OA\Property(
                                property: "error",
                                type: "string",
                                description: "Описание ошибки, если что-то пошло не так",
                                example: 'Сервис временно недоступен, пожалуйста, попробуйте позже'
                            ),
                        ]
                    )
                )
            ]
        );
    }
}

