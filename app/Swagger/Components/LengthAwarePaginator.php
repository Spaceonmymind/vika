<?php

namespace App\Swagger\Components;

use OpenApi\Attributes as OA;

#[OA\Schema(
    description: 'Length-aware пагинация',
    properties: [
        new OA\Property(
            property: 'current_page',
            description: 'Текущая страница',
            type: 'integer',
            example: 1,
        ),
        new OA\Property(
            property: 'first_page_url',
            description: 'URL первой страницы',
            type: 'string',
            example: 'http://vi.local/api/admin/users/list?page=1',
        ),
        new OA\Property(
            property: 'from',
            description: 'Номер первого элемента на странице',
            type: ['integer', 'null'],
            example: null,
        ),
        new OA\Property(
            property: 'last_page',
            description: 'Номер последней страницы',
            type: 'integer',
            example: 1,
        ),
        new OA\Property(
            property: 'last_page_url',
            description: 'URL последней страницы',
            type: 'string',
            example: 'http://vi.local/api/admin/users/list?page=1',
        ),
        new OA\Property(
            property: 'links',
            description: 'Массив ссылок для навигации',
            type: 'array',
            items: new OA\Items(
                properties: [
                    new OA\Property(
                        property: 'url',
                        description: 'URL страницы',
                        type: ['string', 'null'],
                        example: null,
                    ),
                    new OA\Property(
                        property: 'label',
                        description: 'Подпись ссылки',
                        type: 'string',
                        example: 'pagination.previous',
                    ),
                    new OA\Property(
                        property: 'active',
                        description: 'Активная ли ссылка',
                        type: 'boolean',
                        example: false,
                    ),
                ],
                type: 'object'
            )
        ),
        new OA\Property(
            property: 'next_page_url',
            description: 'URL следующей страницы',
            type: ['string', 'null'],
            example: null,
        ),
        new OA\Property(
            property: 'path',
            description: 'Базовый URL',
            type: 'string',
            example: 'http://vi.local/api/admin/users/list',
        ),
        new OA\Property(
            property: 'per_page',
            description: 'Количество элементов на страницу',
            type: 'integer',
            example: 15,
        ),
        new OA\Property(
            property: 'prev_page_url',
            description: 'URL предыдущей страницы',
            type: ['string', 'null'],
            example: null,
        ),
        new OA\Property(
            property: 'to',
            description: 'Номер последнего элемента на странице',
            type: ['integer', 'null'],
            example: null,
        ),
        new OA\Property(
            property: 'total',
            description: 'Общее количество элементов',
            type: 'integer',
            example: 0,
        ),
    ]
)]
class LengthAwarePaginator {}
