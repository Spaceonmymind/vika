<?php

namespace Modules\KMNSSupportWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetActivityTypes extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/kmns_support/get_activity_types",
            operationId: "getKMNSSupportWidgetActivityTypes",
            summary: "Возвращает список сфер жизнедеятельности",
            tags: ['KMNSSupportWidget'],
            parameters: [
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
                                    description: 'Идентификатор сферы жизнедеятельности',
                                    type: 'integer',
                                    example: 2
                                ),
                                new OA\Property(
                                    property: 'name',
                                    description: 'Наименование сферы жизнедеятельности',
                                    type: 'string',
                                    example: 'Традиционная хозяйственная деятельность'
                                ),
                            ]
                        )
                    )
                ),
            ],
        );
    }
}
