<?php

namespace Modules\TimetableWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetTimetable extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/timetable/get_timetable',
            operationId: 'getTimetable',
            summary: 'Получить расписание сотрудника',
            tags: ['TimetableWidget'],
            parameters: [
                new OA\Parameter(
                    name: 'employee_uuid',
                    in: 'query',
                    description: 'Уникальный идентификатор сотрудника',
                    required: true,
                    schema: new OA\Schema(type: 'string')
                ),
                new OA\Parameter(
                    name: 'month',
                    in: 'query',
                    description: 'Месяц за который запрашивается расписание',
                    required: true,
                    schema: new OA\Schema(type: 'integer', minimum: 1, maximum: 12)
                ),
                new OA\Parameter(
                    name: 'year',
                    in: 'query',
                    description: 'Год за который запрашивается расписание',
                    required: true,
                    schema: new OA\Schema(type: 'integer', minimum: 1000, maximum: 9999)
                )
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Successful operation',
                    content: new OA\JsonContent(
                        type: 'array',
                        items: new OA\Items(
                            type: 'object',
                            properties: [
                                new OA\Property(
                                    property: 'day',
                                    description: 'День месяца',
                                    type: 'integer'
                                ),
                                new OA\Property(
                                    property: 'month',
                                    description: 'Месяц',
                                    type: 'integer'
                                ),
                                new OA\Property(
                                    property: 'year',
                                    description: 'Год',
                                    type: 'integer'
                                ),
                                new OA\Property(
                                    property: 'status',
                                    description: 'Статус дня',
                                    type: 'string'
                                ),
                            ]
                        )
                    )
                )
            ]
        );
    }
}
