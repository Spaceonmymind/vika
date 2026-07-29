<?php

namespace Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetTmkConsultations extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/appointment_to_doctor/get_tmk_consultations",
            operationId: "GetTmkConsultations",
            summary: "Получить список ТМК консультаций для пациента",
            tags: ['AppointmentToDoctorWidget'],
            requestBody: new OA\RequestBody(
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        required: ['web_app_data', 'hash', 'patient_id'],
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
                                example: 'fb3715a8ab3310ee358454557e150084a8b859ae1e7a9d1fa214d2cf1ec7c29b'
                            ),
                            new OA\Property(
                                property: 'patient_id',
                                type: 'string',
                                description: 'Идентификатор пациента',
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
                        type: "object",
                        properties: [
                            new OA\Property(
                                property: "success",
                                type: "boolean",
                                description: "Успешность получения консультаций",
                                example: false
                            ),
                            new OA\Property(
                                property: "consultations",
                                type: "array",
                                items: new OA\Items(type: "object"),
                                description: "Список ТМК консультаций",
                                example: []
                            ),
                            new OA\Property(
                                property: "error",
                                type: "string",
                                description: "Описание ошибки, если получение не удалось",
                                example: "У вас нет активной возможности записи на телемедицинскую консультацию, запишитесь к необходимому специалисту и после приема вам назначат ТМК при необходимости"
                            ),
                        ]
                    )
                )
            ]
        );
    }
}

