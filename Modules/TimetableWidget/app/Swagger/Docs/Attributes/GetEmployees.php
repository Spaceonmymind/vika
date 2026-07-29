<?php

namespace Modules\TimetableWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetEmployees extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/timetable/get_employees',
            operationId: 'getEmployees',
            summary: 'Получить список сотрудников организации',
            tags: ['TimetableWidget'],
            parameters: [
                new OA\Parameter(
                    name: 'organization_id',
                    in: 'query',
                    description: 'Идентификатор организации',
                    required: false,
                    schema: new OA\Schema(type: 'integer')
                ),
                new OA\Parameter(
                    name: 'fio',
                    in: 'query',
                    description: 'ФИО сотрудника',
                    required: false,
                    schema: new OA\Schema(type: 'string')
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
                                    property: 'id',
                                    description: 'Идентификатор сотрудника',
                                    type: 'integer'
                                ),
                                new OA\Property(
                                    property: 'organization_id',
                                    description: 'Идентификатор организации',
                                    type: 'integer'
                                ),
                                new OA\Property(
                                    property: 'global_id',
                                    description: 'Глобальный идентификатор сотрудника',
                                    type: 'string'
                                ),
                                new OA\Property(
                                    property: 'post',
                                    description: 'Должность',
                                    type: 'string'
                                ),
                                new OA\Property(
                                    property: 'name',
                                    description: 'ФИО сотрудника',
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
