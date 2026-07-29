<?php

namespace Modules\ActirovkiWidget\Swagger\Docs\Attributes\CityController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class Index extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/actirovki/cities',
            operationId: 'indexCityActirovkiWidget',
            summary: 'Получить список населенных пунктов',
            tags: ['ActirovkiWidgetPublic'],
            parameters: [
                new OA\Parameter(
                    name: 'page',
                    description: 'Номер страницы для пагинации (если не указано, то пагинация не используется)',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'integer', example: 1),
                ),
                new OA\Parameter(
                    name: 'per_page',
                    description: 'Количество элементов на странице',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'integer', example: 20),
                ),
                new OA\Parameter(
                    name: 'sort',
                    description: 'Поле сортировки, например name или -name',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'string', example: 'name'),
                ),
                new OA\Parameter(
                    name: 'filter[name]',
                    description: 'Фильтр по названию населенного пункта',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'string', example: 'Ханты-Мансийск'),
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'Успешный ответ  (список или пагинация)',
                    content: new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: 'data',
                                description: 'Список населенных пунктов',
                                type: 'array',
                                items: new OA\Items(
                                    ref: '#/components/schemas/City'
                                )
                            ),
                            new OA\Property(
                                property: 'meta',
                                description: 'Метаданные пагинации (LengthAwarePaginator)',
                                properties: [
                                    new OA\Property(property: 'total', type: 'integer', example: 100),
                                    new OA\Property(property: 'count', type: 'integer', example: 15),
                                    new OA\Property(property: 'per_page', type: 'integer', example: 15),
                                    new OA\Property(property: 'current_page', type: 'integer', example: 1),
                                    new OA\Property(property: 'total_pages', type: 'integer', example: 7),
                                ],
                                type: 'object',
                            ),
                            new OA\Property(
                                property: 'links',
                                description: 'Ссылки пагинации (LengthAwarePaginator)',
                                properties: [
                                    new OA\Property(property: 'first', type: 'string', example: '/api/widget/actirovki/cities?page=1'),
                                    new OA\Property(property: 'last', type: 'string', example: '/api/widget/actirovki/cities?page=7'),
                                    new OA\Property(property: 'prev', type: 'string', example: null),
                                    new OA\Property(property: 'next', type: 'string', example: '/api/widget/actirovki/cities?page=2'),
                                ],
                                type: 'object',
                            ),
                        ],
                        type: "object"
                    ),
                ),
            ],
        );
    }
}
