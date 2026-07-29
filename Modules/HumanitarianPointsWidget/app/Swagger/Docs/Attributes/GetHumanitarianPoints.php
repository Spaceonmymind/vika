<?php

namespace Modules\HumanitarianPointsWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetHumanitarianPoints extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/humanitarian_points/get_humanitarian_points',
            operationId: 'getHumanitarianPointsWidgetHumanitarianPoints',
            summary: 'Получить список Муниципалитетов',
            tags: ['HumanitarianPointsWidget'],
            parameters: [
                new OA\Parameter(
                    name: 'municipality_id',
                    in: 'query',
                    required: false,
                    description: 'Идентификатор муниципалитета',
                    schema: new OA\Schema(
                        type: 'integer',
                    ),
                    example: 1,
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
                                    description: 'Идентификатор пункта приёма гум помощи',
                                    type: 'integer',
                                    example: 1
                                ),
                                new OA\Property(
                                    property: 'name',
                                    description: 'Название мероприятия',
                                    type: 'string',
                                    example: 'Центральный региональный пункт сбора гуманитарной помощи'
                                ),
                                new OA\Property(
                                    property: 'address',
                                    description: 'Адрес пункта приёма гум помощи',
                                    type: 'string',
                                    example: 'г. Сургут, ул. Мелик-Карамова 4/4'
                                ),
                                new OA\Property(
                                    property: 'contact_person_fio',
                                    description: 'Фио контактного лица',
                                    type: 'string',
                                    example: 'Дидус Людмила Александровна; Пономаренко Юлия Валентиновна +7 901 502 7349'
                                ),
                                new OA\Property(
                                    property: 'contact_person_email',
                                    description: 'Электронная почтка контактного лица',
                                    type: 'string',
                                    example: 'olesyabars@yandex.ru'
                                ),
                                new OA\Property(
                                    property: 'contact_person_phone',
                                    description: 'Номер телефона контактного лица',
                                    type: 'string',
                                    example: '+7 929 007 9778;  +7 901 502 7349'
                                ),
                                new OA\Property(
                                    property: 'municipality_id',
                                    description: 'Идентификатор муниципалитета',
                                    type: 'integer',
                                    example: 1
                                ),
                                new OA\Property(
                                    property: 'municipality',
                                    description: 'Муниципалитет',
                                    type: 'object',
                                    properties: [
                                        new OA\Property(
                                            property: 'id',
                                            description: 'Идентификатор муниципалитета',
                                            type: 'integer',
                                            example: 1
                                        ),
                                        new OA\Property(
                                            property: 'name',
                                            description: 'Название муниципалитета',
                                            type: 'string',
                                            example: 'Сургут'
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
