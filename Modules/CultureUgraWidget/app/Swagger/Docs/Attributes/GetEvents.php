<?php

namespace Modules\CultureUgraWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetEvents extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/culture_ugra/get_events',
            operationId: 'getCultureUgraWidgetEvents',
            summary: 'Получить список культурных мероприятий',
            tags: ['CultureUgraWidget'],
            parameters: [
                new OA\Parameter(
                    name: 'locality_id',
                    in: 'query',
                    required: false,
                    description: 'Идентификатор населённого пункта',
                    schema: new OA\Schema(
                        type: 'integer',
                    ),
                    example: 155,
                ),
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
                                    description: 'Идентификатор мероприятия',
                                    type: 'integer',
                                    example: 430
                                ),
                                new OA\Property(
                                    property: 'name',
                                    description: 'Название мероприятия',
                                    type: 'string',
                                    example: 'Спектакль "Что случилось с крокодилом" 0+'
                                ),
                                new OA\Property(
                                    property: 'locality_id',
                                    description: 'Идентификатор населённого пункта',
                                    type: 'integer',
                                    example: 203
                                ),
                                new OA\Property(
                                    property: 'description',
                                    description: 'Описание мероприятия',
                                    type: 'string',
                                    example: 'Этот папа был зелёным-презелёным, зубастым, хвостастым крокодилом. А его дочка — маленьким, жёлтеньким, пушистым... птенчиком! Да, и такие чудеса в жизни случаются. И совсем неважно, что говорят злые окружающие, глядя на необычную семейку, ведь таких непохожих кроко-папу и птичку-дочку объединяет искренняя любовь!'
                                ),
                                new OA\Property(
                                    property: 'start_date',
                                    description: 'Дата начала',
                                    type: 'string',
                                    example: '2025-04-05T00:00:00+0000'
                                ),
                                new OA\Property(
                                    property: 'end_date',
                                    description: 'Дата окончания',
                                    type: 'string',
                                    example: '2025-04-06T00:00:00+0000'
                                ),
                                new OA\Property(
                                    property: 'organization_name',
                                    description: 'Название организации',
                                    type: 'string',
                                    example: 'БУ "Ханты-Мансийский театр кукол"'
                                ),
                                new OA\Property(
                                    property: 'address',
                                    description: 'Адрес',
                                    type: 'string',
                                    example: 'ул. Мира  д.15'
                                ),
                                new OA\Property(
                                    property: 'buy_link',
                                    description: 'Ссылка на покупку билетов',
                                    type: 'string',
                                    example: 'https://widget.afisha.yandex.ru/w/events/237264?clientKey=50d3a220-c50a-4b45-86fb-97f509708ad1&regionId=57'
                                ),
                                new OA\Property(
                                    property: 'buy_text',
                                    description: 'Надпись на кнопке',
                                    type: 'string',
                                    example: 'Купить билет'
                                ),
                                new OA\Property(
                                    property: 'locality',
                                    description: 'Населённый пункт',
                                    type: 'object',
                                    properties: [
                                        new OA\Property(
                                            property: 'id',
                                            description: 'Идентификатор города',
                                            type: 'integer',
                                            example: 203
                                        ),
                                        new OA\Property(
                                            property: 'name',
                                            description: 'Название города',
                                            type: 'string',
                                            example: 'Ханты-Мансийск'
                                        )
                                    ]
                                ),
                            ]
                        )
                    )
                )
            ]
        );
    }
}
