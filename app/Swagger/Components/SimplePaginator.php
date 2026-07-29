<?php

namespace App\Swagger\Components;

use OpenApi\Attributes as OA;

#[OA\Schema(
    description: 'Simple пагинация',
    properties: [
        new OA\Property(
            property: 'per_page',
            description: 'Количество элементов на странице',
            type: 'integer',
            example: 10,
        ),
        new OA\Property(
            property: 'from',
            description: 'Начиная с какого элемента выводится страница',
            type: 'integer',
            example: 11,
        ),
        new OA\Property(
            property: 'to',
            description: 'До какого элемента выводится информация на странице',
            type: 'integer',
            example: 20,
        ),
        new OA\Property(
            property: 'first_page_url',
            description: 'Ссылка на первую страницу',
            type: ['string', 'null'],
            example: 'http://vi.local/api/chat/get_history?page=1',
        ),
        new OA\Property(
            property: 'next_page_url',
            description: 'Ссылка на следующую страницу',
            type: ['string', 'null'],
            example: 'http://vi.local/api/chat/get_history?page=3',
        ),
        new OA\Property(
            property: 'prev_page_url',
            description: 'Ссылка на предыдущую страницу',
            type: ['string', 'null'],
            example: 'http://vi.local/api/chat/get_history?page=1',
        ),
        new OA\Property(
            property: 'path',
            description: 'Ссылка на метод без указания страниц',
            type: 'string',
            example: 'http://vi.local/api/chat/get_history',
        ),
    ]
)]
class SimplePaginator {}
