<?php

namespace Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class BookSlot extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/appointment_to_doctor/book",
            operationId: "BookSlot",
            summary: "Бронирование слота для записи к врачу",
            tags: ['AppointmentToDoctorWidget'],
            requestBody: new OA\RequestBody(
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        required: ['web_app_data','hash','patient_id','depart_oid','slot_id','mo_oid'],
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
                                property: 'patient_id',
                                type: 'string',
                                description: 'ID пациента',
                                example: '0dd8f2b8-3246-4c16-9349-e6e02cb1108b'
                            ),
                            new OA\Property(
                                property: 'depart_oid',
                                type: 'string',
                                description: 'OID подразделения (филиала)',
                                example: '1.2.643.5.1.13.13.12.2.86.8936.0.642411'
                            ),
                            new OA\Property(
                                property: 'mo_oid',
                                type: 'string',
                                description: 'OID мед.организации',
                                example: '1.2.643.5.1.13.13.12.2.86.8936'
                            ),
                            new OA\Property(
                                property: 'slot_id',
                                type: 'string',
                                description: 'ID выбранного слота',
                                example: '8a2c21d1-9d2f-4bed-e700-6b8a8c958724'
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
                                description: "Успешность бронирования",
                                example: true
                            ),
                            new OA\Property(
                                property: "error",
                                type: "string",
                                description: "Описание ошибки, если что-то пошло не так",
                                example: 'Сервис временно недоступен, пожалуйста, попробуйте позже'
                            ),
                            new OA\Property(
                                property: "book_ext_id",
                                type: "string",
                                description: "Внешний гуид слота(бронирования)",
                                example: '82f2413a-02ae-4eca-dd17-1e4927cd2415'
                            ),
                        ]
                    )
                )
            ]
        );
    }
}

