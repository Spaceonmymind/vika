<?php

namespace Modules\ActirovkiWidget\Swagger\Docs\Attributes\RowController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class Cancel extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/actirovki/rows/{row}/cancel',
            operationId: 'cancelRowActirovkiWidget',
            summary: 'Отмена актировки',
            tags: ['ActirovkiWidgetPrivate'],
            parameters: [
                new OA\Parameter(
                    name: 'row',
                    description: 'ID актировки',
                    in: 'path',
                    required: true,
                    schema: new OA\Schema(type: 'integer'),
                    example: 1
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Успешный ответ',
                    content: new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: 'data',
                                ref: '#/components/schemas/Row'
                            )
                        ],
                        type: 'object'
                    )
                ),
            ],
        );
    }
}
