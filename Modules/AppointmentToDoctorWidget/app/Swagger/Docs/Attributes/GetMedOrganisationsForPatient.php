<?php

namespace Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetMedOrganisationsForPatient extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/appointment_to_doctor/get_med_organisations",
            operationId: "GetMedOrganisationsForPatient",
            summary: "Получение списка медицинских организаций, доступных для пациента",
            tags: ['AppointmentToDoctorWidget'],
            requestBody: new OA\RequestBody(
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        required: ['web_app_data','hash','patient_id'],
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
                                property: "med_organisations",
                                type: "array",
                                description: "Список медицинских организаций",
                                items: new OA\Items(
                                    properties: [
                                        new OA\Property(
                                            property: "id",
                                            type: "string",
                                            description: "ID организации",
                                            example: "b64cc6f4-4a81-48d8-4004-ef756af86d6f"
                                        ),
                                        new OA\Property(
                                            property: "parent_id",
                                            type: "string",
                                            description: "OID головной организации",
                                            example: "1.2.643.5.1.13.13.12.2.86.8936"
                                        ),
                                        new OA\Property(
                                            property: "name",
                                            type: "string",
                                            description: "Название организации",
                                            example: "Прикрепление с бронированием"
                                        ),
                                        new OA\Property(
                                            property: "parent_name",
                                            type: "string",
                                            description: "Название головной организации",
                                            example: "автономное учреждение Ханты-Мансийского автономного округа - Югры \"Мегионская городская стоматологическая поликлиника\""
                                        ),
                                        new OA\Property(
                                            property: "branch_oid",
                                            type: "string",
                                            description: "OID филиала",
                                            example: "1.2.643.5.1.13.13.12.2.86.8936.0.642411"
                                        ),
                                        new OA\Property(
                                            property: "address",
                                            type: "string",
                                            description: "Адрес филиала",
                                            example: "Республика Башкортосатан, г. Уфа, ул. Ленина, дом 22"
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

