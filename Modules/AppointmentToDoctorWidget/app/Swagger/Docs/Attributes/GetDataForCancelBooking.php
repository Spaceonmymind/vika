<?php

namespace Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetDataForCancelBooking extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/appointment_to_doctor/get_data_for_cancel_booking",
            operationId: "getDataForCancelBooking",
            summary: "Получить данные для отмены записи",
            tags: ['AppointmentToDoctorWidget'],
            requestBody: new OA\RequestBody(
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        required: ['patient_id', 'slot_id', 'resource_id'],
                        properties: [

                            new OA\Property(
                                property: 'patient_id',
                                type: 'string',
                                description: 'ID пациента',
                                example: '0dd8f2b8-3246-4c16-9349-e6e02cb1108b'
                            ),
                            new OA\Property(
                                property: 'slot_id',
                                type: 'string',
                                description: 'ID выбранного слота',
                                example: '8a2c21d1-9d2f-4bed-e700-6b8a8c958724'
                            ),
                            new OA\Property(
                                property: 'resource_id',
                                type: 'string',
                                description: 'ID ресурса (врача)',
                                example: 'fff21126-ffff-ffff-fff0-ffffff389094'
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
                            new OA\Property(property: "success", type: "boolean", example: true),
                            new OA\Property(
                                property: "slot",
                                type: "object",
                                properties: [
                                    new OA\Property(property: "slot_id", type: "string", example: "0285fbc5-9ec2-4b19-be61-1a0795d91a69"),
                                    new OA\Property(property: "depart_oid", type: "string", example: "1.2.643.5.1.13.13.12.2.86.8902.0.469121"),
                                    new OA\Property(property: "mo_oid", type: "string", example: "1.2.643.5.1.13.13.12.2.86.8902"),
                                    new OA\Property(property: "book_ext_id", type: "string", example: "615daf6d-3563-49b1-9e9f-9b5f95afbdfd"),
                                    new OA\Property(property: "patient_id", type: "string", example: "5c81ba0b-580a-7a8c-e055-000000000001"),
                                ]
                            ),
                        ],
                        examples: [
                            new OA\Examples(
                                example: "SuccessfulResponse",
                                summary: "Успешный ответ",
                                value: [
                                    "success" => true,
                                    "slot" => [
                                        "slot_id" => "0285fbc5-9ec2-4b19-be61-1a0795d91a69",
                                        "depart_oid" => "1.2.643.5.1.13.13.12.2.86.8902.0.469121",
                                        "mo_oid" => "1.2.643.5.1.13.13.12.2.86.8902",
                                        "book_ext_id" => "615daf6d-3563-49b1-9e9f-9b5f95afbdfd",
                                        "patient_id" => "5c81ba0b-580a-7a8c-e055-000000000001",
                                    ]
                                ]
                            ),
                            new OA\Examples(
                                example: "error",
                                summary: "Ошибка",
                                value: [
                                    "success" => false,
                                    "error" => "Сервис временно недоступен, вы сможете отменить запись через портал пациента"
                                ]
                            ),

                        ]
                    )
                )
            ]
        );
    }
}

