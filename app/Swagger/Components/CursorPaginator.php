<?php

namespace App\Swagger\Components;

use OpenApi\Attributes as OA;

#[OA\Schema(
    description: 'Cursor-based пагинация',
    properties: [
        new OA\Property(
            property: 'per_page',
            description: 'Количество элементов на странице',
            type: 'integer',
            example: 20,
        ),
        new OA\Property(
            property: 'path',
            description: 'Ссылка, куда было обращение',
            type: ['string', 'null'],
            example: 'http://vi.local/api/widget/business_support/get_measures',
        ),
        new OA\Property(
            property: 'next_cursor',
            description: 'Курсор для следующей страницы',
            type: ['string', 'null'],
            example: 'eyJidXNpbmVzc19zdXBwb3J0X3dpZGdldF9tZWFzdXJlcy5pZCI6MTUsIl9wb2ludHNUb05leHRJdGVtcyI6dHJ1ZX0',
        ),
        new OA\Property(
            property: 'next_page_url',
            description: 'URL для следующей страницы',
            type: ['string', 'null'],
            example: 'http://vi.local/api/widget/business_support/get_measures?cursor=eyJidXNpbmVzc19zdXBwb3J0X3dpZGdldF9tZWFzdXJlcy5pZCI6MTUsIl9wb2ludHNUb05leHRJdGVtcyI6dHJ1ZX0',
        ),
        new OA\Property(
            property: 'prev_cursor',
            description: 'Курсор для предыдущей страницы',
            type: ['string', 'null'],
            example: null,
        ),
        new OA\Property(
            property: 'prev_page_url',
            description: 'URL для предыдущей страницы',
            type: ['string', 'null'],
            example: null,
        ),
    ]
)]
class CursorPaginator {}
