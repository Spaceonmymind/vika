<?php

namespace Modules\DistrictSearchWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetDistricts extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/district_search/get_districts',
            operationId: 'getDistricts',
            tags: ['DistrictSearchWidget'],
            summary: 'Получить список участков по населённому пункту',
            parameters: [
                new OA\Parameter(
                    name: 'street_id',
                    in: 'query',
                    required: true,
                    description: 'Идентификатор улицы в населённом пункте',
                    schema: new OA\Schema(
                        type: 'integer',
                    ),
                ),
                new OA\Parameter(
                    name: 'house_number',
                    in: 'query',
                    required: true,
                    description: 'Номер дома',
                    schema: new OA\Schema(
                        type: 'string',
                    ),
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Successful operation',
                    content: new OA\JsonContent(
                        type: 'object',
                        properties: [
                            new OA\Property(
                                property: 'id',
                                type: 'integer',
                                description: 'Уникальный идентификатор участка',
                                example: 10372,
                            ),
                            new OA\Property(
                                property: 'number',
                                type: 'string',
                                description: 'Номер участка',
                                example: '3',
                            ),
                            new OA\Property(
                                property: 'type',
                                type: 'string',
                                description: 'Тип участка',
                                example: 'общей практики',
                            ),
                            new OA\Property(
                                property: 'address',
                                type: 'string',
                                description: 'Адрес местоположения участка',
                                example: 'Ханты-Мансийск, улица Анны Коньковой, 2'
                            ),
                            new OA\Property(
                                property: 'hospital_id',
                                type: 'integer',
                                description: 'Уникальный идентификатор медицинского учреждения',
                                example: 344,
                            ),
                            new OA\Property(
                                property: 'district_search_widget_hospital',
                                type: 'object',
                                description: 'Информация о больнице',
                                properties: [
                                    new OA\Property(
                                        property: 'id',
                                        type: 'integer',
                                        description: 'Уникальный идентификатор медицинского учреждения',
                                        example: 344,
                                    ),
                                    new OA\Property(
                                        property: 'name',
                                        type: 'string',
                                        description: 'Наименование медицинского учреждения',
                                        example: 'БУ «Ханты-Мансийская районная больница»',
                                        nullable: true
                                    ),
                                    new OA\Property(
                                        property: 'address',
                                        type: 'string',
                                        description: 'Адрес медицинского учреждения',
                                        example: 'Ханты-Мансийск, улица Анны Коньковой, 2',
                                        nullable: true
                                    ),
                                    new OA\Property(
                                        property: 'site',
                                        type: 'string',
                                        description: 'Сайт медицинского учреждения',
                                        example: 'khmrb.ru',
                                        nullable: true
                                    ),
                                    new OA\Property(
                                        property: 'email',
                                        type: 'string',
                                        description: 'Адрес электронной почты медицинского учреждения',
                                        example: 'info@khmrb.ru',
                                        nullable: true
                                    ),
                                    new OA\Property(
                                        property: 'phone',
                                        type: 'string',
                                        description: 'Номер телефона медицинского учреждения',
                                        example: '+7 3467-36-02-06',
                                        nullable: true
                                    ),
                                ],
                            ),
                            new OA\Property(
                                property: 'district_search_widget_doctors',
                                type: 'array',
                                description: 'Список докторов, которые работают в данном медицинском участке',
                                items: new OA\Items(
                                    type: 'object',
                                    properties: [
                                        new OA\Property(
                                            property: 'id',
                                            type: 'integer',
                                            description: 'Уникальный идентификатор врача',
                                            example: 344,
                                        ),
                                        new OA\Property(
                                            property: 'last_name',
                                            type: 'string',
                                            description: 'Фамилия врача',
                                            example: 'Маковийчук',
                                        ),
                                        new OA\Property(
                                            property: 'first_name',
                                            type: 'string',
                                            description: 'Имя врача',
                                            example: 'Любовь',
                                        ),
                                        new OA\Property(
                                            property: 'middle_name',
                                            type: 'string',
                                            description: 'Отчество врача',
                                            example: 'Юрьевна',
                                        ),
                                        new OA\Property(
                                            property: 'phone',
                                            type: 'string',
                                            description: 'Номер телефона участка',
                                            example: '8(3467)376-693',
                                            nullable: true
                                        ),
                                        new OA\Property(
                                            property: 'even_week_timetable_records',
                                            type: 'array',
                                            description: 'Расписание на чётную неделю',
                                            items: new OA\Items(
                                                type: 'object',
                                                description: 'Расписание врача на день',
                                                ref: '#/components/schemas/DoctorDayTimetableRecord',
                                            ),
                                            minItems: 0,
                                        ),
                                        new OA\Property(
                                            property: 'odd_week_timetable_records',
                                            type: 'array',
                                            description: 'Расписание на нечётную неделю',
                                            items: new OA\Items(
                                                type: 'object',
                                                description: 'Расписание врача на день',
                                                ref: '#/components/schemas/DoctorDayTimetableRecord',
                                                minItems: 0,
                                            ),
                                        ),
                                    ],
                                ),
                            ),
                        ],
                    ),
                ),
            ],
        );
    }
}
