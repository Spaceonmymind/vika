<?php

namespace Modules\BusinessSupportWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetSubjects extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/business_support/get_subjects",
            operationId: "getBusinessSupportWidgetSubjects",
            summary: "Возвращает список получателей поддержки",
            tags: ['BusinessSupportWidget'],
            parameters: [
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Successful operation",
                    content: new OA\JsonContent(
                        type: "array",
                        items: new OA\Items(
                           ref: '#/components/schemas/BusinessSupportSubject',
                        ),
                    ),
                ),
            ],
        );
    }
}
