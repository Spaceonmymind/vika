<?php

namespace Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetBooksByPatientId extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/appointment_to_doctor/get_booking_list",
            operationId: "getBooksByPatientId",
            summary: "Получить список активных броней слотов по ID пациента",
            tags: ['AppointmentToDoctorWidget'],
            requestBody: new OA\RequestBody(
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        required: ['patient_id'],
                        properties: [
                            new OA\Property(
                                property: 'patient_id',
                                type: 'string',
                                description: 'ID пациента',
                                example: '0dd8f2b8-3246-4c16-9349-e6e02cb1108b'
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
                        oneOf: [
                            new OA\Schema(
                                type: "object",
                                properties: [
                                    new OA\Property(property: "success", type: "boolean", example: true),
                                    new OA\Property(
                                        property: "booking_list",
                                        type: "array",
                                        items: new OA\Items(
                                            properties: [
                                                new OA\Property(property: "id", type: "string", example: "615daf6d-3563-49b1-9e9f-9b5f95afbdfd"),
                                                new OA\Property(property: "slot_id", type: "string", example: "0285fbc5-9ec2-4b19-be61-1a0795d91a69"),
                                                new OA\Property(property: "status_code", type: "integer", example: 5000),
                                                new OA\Property(property: "type", type: "string", example: "APPOINTMENT"),
                                                new OA\Property(property: "visit_time", type: "string", format: "date-time", example: "21-10-2025 16:12"),
                                                new OA\Property(property: "duration", type: "integer", example: 12),
                                                new OA\Property(property: "post_name", type: "string", example: "Врач-терапевт участковый"),
                                                new OA\Property(property: "doctor_last_name", type: "string", example: "СЛИНКИНА"),
                                                new OA\Property(property: "doctor_first_name", type: "string", example: "ЕКАТЕРИНА"),
                                                new OA\Property(property: "doctor_middle_name", type: "string", example: "ВАЛЕРЬЕВНА"),
                                                new OA\Property(property: "mo_name", type: "string", example: "БУ \"Окружная клиническая больница\", Терапевтическое отделение №3  (ул. Рябиновая)"),
                                                new OA\Property(property: "address", type: "string", example: "628002, ХМАО-Югра, г. Ханты-Мансийск, ул. Рябиновая д.20"),
                                                new OA\Property(property: "referral_id", type: "string", example: "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa"),
                                                new OA\Property(property: "protocol_id", type: "string", nullable: true, example: null),
                                                new OA\Property(property: "resource_id", type: "string", example: "fff21126-ffff-ffff-fff0-ffffff419973"),
                                            ]
                                        )
                                    ),
                                ]
                            ),
                            new OA\Schema(
                                type: "object",
                                properties: [
                                    new OA\Property(property: "success", type: "boolean", example: false),
                                    new OA\Property(property: "error", type: "string", example: "Сервис временно недоступен, вы сможете отменить запись через портал пациента"),
                                ]
                            ),
                        ],
                        examples: [
                            new OA\Examples(
                                example: "success",
                                summary: "Успешный ответ",
                                value: [
                                    "success" => true,
                                    "booking_list" => [
                                        [
                                            "id" => "615daf6d-3563-49b1-9e9f-9b5f95afbdfd",
                                            "slot_id" => "0285fbc5-9ec2-4b19-be61-1a0795d91a69",
                                            "status_code" => 5000,
                                            "type" => "APPOINTMENT",
                                            "visit_time" => "21.10.2025 16:12",
                                            "duration" => 12,
                                            "post_name" => "Врач-терапевт участковый",
                                            "doctor_last_name" => "СЛИНКИНА",
                                            "doctor_first_name" => "ЕКАТЕРИНА",
                                            "doctor_middle_name" => "ВАЛЕРЬЕВНА",
                                            "mo_name" => "БУ \"Окружная клиническая больница\", Терапевтическое отделение №3  (ул. Рябиновая)",
                                            "address" => "628002, ХМАО-Югра, г. Ханты-Мансийск, ул. Рябиновая д.20",
                                            "referral_id" => "aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa",
                                            "protocol_id" => null,
                                            "resource_id" => "fff21126-ffff-ffff-fff0-ffffff419973",
                                        ]
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

