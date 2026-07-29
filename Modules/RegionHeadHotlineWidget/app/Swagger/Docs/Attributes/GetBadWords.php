<?php

namespace Modules\RegionHeadHotlineWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetBadWords extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: "/api/widget/region_head_hotline/get_bad_words",
            operationId: "RegionHeadHotlineWidgetGetBadWords",
            summary: "Получение списка нецензурных слов из жалобы через горячую линию губернатора",
            tags: ['RegionHeadHotlineWidget'],
            parameters: [
                new OA\Parameter(
                    name: "complaint",
                    in: "query",
                    required: true,
                    description: "Текст жалобы для поиска нецензурных слов",
                    schema: new OA\Schema(
                        type: "string",
                        example: "джигУрда  я вертел вас всех на хую ёБаНный в ротик хуй. вотпиздить"
                    )
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: "Массив найденных нецензурных слов",
                    content: new OA\JsonContent(
                        type: "array",
                        items: new OA\Items(
                            type: "string",
                            example: "хую"
                        ),
                        example: [
                            "вотпиздить",
                            "хую",
                            "хуй",
                            "ёБаНный"
                        ]
                    )
                )
            ]
        );
    }
}

