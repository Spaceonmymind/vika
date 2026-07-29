<?php

namespace Modules\TimetableWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetOrganizations  extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/timetable/get_organizations',
            operationId: 'getOrganizations',
            summary: 'Получить список организаций',
            tags: ['TimetableWidget'],
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
                                    description: 'Идентификатор организации',
                                    type: 'integer'
                                ),
                                new OA\Property(
                                    property: 'name',
                                    description: 'Название организации',
                                    type: 'string'
                                ),
                                new OA\Property(
                                    property: 'timesheet_name',
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
