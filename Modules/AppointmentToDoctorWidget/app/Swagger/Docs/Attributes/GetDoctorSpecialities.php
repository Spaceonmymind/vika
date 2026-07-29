<?php

namespace Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetDoctorSpecialities extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/appointment_to_doctor/get_doctor_specialities",
            operationId: "GetDoctorSpecialities",
            summary: "Получение списка специальностей врачей для выбранной МО",
            tags: ['AppointmentToDoctorWidget'],
            requestBody: new OA\RequestBody(
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        required: ['web_app_data','hash','patient_id','med_organisation_guid'],
                        properties: [
                            new OA\Property(
                                property: 'web_app_data',
                                type: 'string',
                                description: 'Подготовленные данные, полученные из web app (обрезанные)',
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
                                property: 'med_organisation_guid',
                                type: 'string',
                                description: 'GUID выбранной медицинской организации',
                                example: 'b64cc6f4-4a81-48d8-4004-ef756af86d6f'
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
                                description: "Успешность получения списка",
                                example: true
                            ),
                            new OA\Property(
                                property: "doctor_specialities",
                                type: "array",
                                description: "Список специальностей врачей",
                                items: new OA\Items(
                                    properties: [
                                        new OA\Property(
                                            property: "post_id",
                                            type: "string",
                                            description: "ID специальности",
                                            example: "54"
                                        ),
                                        new OA\Property(
                                            property: "post_name",
                                            type: "string",
                                            description: "Название специальности",
                                            example: "Врач-офтальмолог"
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

