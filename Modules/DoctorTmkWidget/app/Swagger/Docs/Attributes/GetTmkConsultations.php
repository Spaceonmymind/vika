<?php

namespace Modules\DoctorTmkWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetTmkConsultations extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/doctor-tmk/consultations",
            operationId: "telemedicineConsultations",
            summary: "Получить список ТМК консультаций для пациента",
            tags: ['DoctorTmkWidget'],
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Успешная операция. В ответе: has_auth (авторизация), success, consultations (список консультаций), error (ошибка, если есть)",
                    content: new OA\JsonContent(
                        type: "object",
                        properties: [
                            new OA\Property(
                                property: "has_auth",
                                type: "boolean",
                                description: "Авторизован ли пользователь",
                                example: true
                            ),
                            new OA\Property(
                                property: "success",
                                type: "boolean",
                                description: "Успешность получения консультаций",
                                example: true
                            ),
                            new OA\Property(
                                property: "consultations",
                                type: "array",
                                description: "Список ТМК консультаций",
                                items: new OA\Items(
                                    type: "object",
                                    properties: [
                                        new OA\Property(property: "id", type: "integer", example: 1),
                                        new OA\Property(property: "direction_guid", type: "string", example: "test`"),
                                        new OA\Property(property: "request_med_organisation_id", type: "integer", example: 1),
                                        new OA\Property(property: "target_med_organisation_id", type: "integer", example: 1),
                                        new OA\Property(property: "doctor_fio", type: "string", example: "test"),
                                        new OA\Property(property: "scheduled_date_time", type: "string", example: "23.11.2025 17:13:24"),
                                        new OA\Property(property: "consultation_url", type: "string", example: "https://telemost.360.yandex.ru/j/5257029110"),
                                        new OA\Property(property: "reason", type: "string", example: "test"),
                                        new OA\Property(property: "patient_fio", type: "string", example: "Иванов Иван Иванович"),
                                        new OA\Property(
                                            property: "target_med_organisation",
                                            type: "object",
                                            properties: [
                                                new OA\Property(property: "id", type: "integer", example: 1),
                                                new OA\Property(property: "name", type: "string", example: "БУ \"Нижневартовская городская детская поликлиника\""),
                                                new OA\Property(property: "oid_mo", type: "string", example: "1.2.643.5.1.13.13.12.2.86.9001"),
                                                new OA\Property(property: "show_in_pos", type: "integer", example: 1),
                                                new OA\Property(property: "miac_med_organisation_id", type: "integer", example: 28),
                                                new OA\Property(property: "portal_id", type: "integer", example: 61),
                                            ]
                                        ),
                                    ]
                                ),
                                example: [
                                    [
                                        "id" => 1,
                                        "direction_guid" => "test`",
                                        "request_med_organisation_id" => 1,
                                        "target_med_organisation_id" => 1,
                                        "doctor_fio" => "test",
                                        "scheduled_date_time" => "23.11.2025 17:13:24",
                                        "consultation_url" => "https://telemost.360.yandex.ru/j/5257029110",
                                        "reason" => "test",
                                        "target_med_organisation" => [
                                            "id" => 1,
                                            "name" => "БУ \"Нижневартовская городская детская поликлиника\"",
                                            "oid_mo" => "1.2.643.5.1.13.13.12.2.86.9001",
                                            "show_in_pos" => 1,
                                            "miac_med_organisation_id" => 28,
                                            "portal_id" => 61
                                        ]
                                    ]
                                ]
                            ),
                            new OA\Property(
                                property: "error",
                                type: "string",
                                description: "Описание ошибки, если получение не удалось",
                                example: "Не удалось получить данные о телемедицинских консультациях"
                            ),
                        ]
                    )
                )
            ]
        );
    }
}
