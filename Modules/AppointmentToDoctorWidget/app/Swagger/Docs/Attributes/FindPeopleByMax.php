<?php

namespace Modules\AppointmentToDoctorWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class FindPeopleByMax  extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/appointment_to_doctor/find_people_by_max",
            operationId: "FindPeopleByMax",
            summary: "Поиск пациентов в РРП по номеру телефона из МАКС",
            tags: ['AppointmentToDoctorWidget'],
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
                                example: 'Пациент с данным номером телефона не найден'
                            ),
                            new OA\Property(
                                property: "patients",
                                type: "array",
                                description: "Найденные пациенты",
                                items: new OA\Items(
                                    properties: [
                                        new OA\Property(
                                            property: "guid",
                                            type: "string",
                                            description: "ID пациента",
                                            example: '5C81BA0B-580A-7A8C-E055-000000000001'
                                        ),
                                        new OA\Property(
                                            property: "last_name",
                                            type: "string",
                                            description: "Фамилия пациента",
                                            example: "ЕМЕЛЬЯНОВ"
                                        ),
                                        new OA\Property(
                                            property: "first_name",
                                            type: "string",
                                            description: "Имя пациента",
                                            example: "ВЛАС"
                                        ),
                                        new OA\Property(
                                            property: "middle_name",
                                            type: "string",
                                            description: "Отчество пациента",
                                            example: "ГРИГОРЬЕВИЧ"
                                        ),
                                        new OA\Property(
                                            property: "birth_date",
                                            type: "string",
                                            description: "Дата рождения пациента",
                                            example: "21.04.1997"
                                        ),
                                    ]
                                )
                            ),

                        ]
                    )
                )
            ]
        );
    }
}
