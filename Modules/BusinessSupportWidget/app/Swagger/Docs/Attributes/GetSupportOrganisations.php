<?php

namespace Modules\BusinessSupportWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetSupportOrganisations extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/business_support/get_support_organisations",
            operationId: "getBusinessSupportWidgetSupportOrganisations",
            summary: "Возвращает список организаций, которые предоставляют поддержку",
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
                           ref: '#/components/schemas/BusinessSupportSupportOrganisation',
                        ),
                    ),
                ),
            ],
        );
    }
}
