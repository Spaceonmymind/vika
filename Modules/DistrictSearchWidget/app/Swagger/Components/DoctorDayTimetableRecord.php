<?php

namespace Modules\DistrictSearchWidget\Swagger\Components;

use OpenApi\Attributes as OA;

#[OA\Schema(

    description: 'Расписание врача на день',
    properties: [
        new OA\Property(
            property: 'id',
            type: 'integer',
            example: 547835,
        ),
        new OA\Property(
            property: 'day_number',
            description: 'Номер дня, 1 - понедельник',
            type: 'integer',
            example: 1,
        ),
        new OA\Property(
            property: 'break_time',
            description: 'Является ли перерывом, true - перерыв, false - рабочее время',
            type: 'string',
            example: '8:00-18:00',
            nullable: true
        ),
        new OA\Property(
            property: 'time',
            description: 'Временной диапазон',
            type: 'string',
            example: '8:00-18:00',
            nullable: true
        ),
        new OA\Property(
            property: 'doctor_id',
            description: 'Идентификатор врача',
            type: 'integer',
            example: 19577,
        ),
    ]
)]
class DoctorDayTimetableRecord {}
