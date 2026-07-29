<?php

namespace Modules\FuelPriceWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetFuelPricesInCity  extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/fuel_price/get_fuel_in_city',
            operationId: 'getFuelPricesInCity',
            summary: 'Получить цены на топливо в городе',
            tags: ['FuelPriceWidget'],
            requestBody: new OA\RequestBody(
                description: 'Input data',
                required: true,
                content: [
                    new OA\MediaType(
                        mediaType: 'application/json',
                        schema: new OA\Schema(
                            type: 'object',
                            properties: [
                                new OA\Property(
                                    property: 'city_id',
                                    description: 'Идентификатор города',
                                    type: 'integer'
                                ),
                                new OA\Property(
                                    property: 'fuel_type_ids',
                                    description: 'Список идентификаторов типов топлива',
                                    type: 'array',
                                    items: new OA\Items(type: 'integer')
                                )
                            ]
                        )
                    )
                ]
            ),
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
                                    description: 'Идентификатор АЗС',
                                    type: 'integer'
                                ),
                                new OA\Property(
                                    property: 'name',
                                    description: 'Название АЗС',
                                    type: 'string'
                                ),
                                new OA\Property(
                                    property: 'company_name',
                                    description: 'Название компании',
                                    type: 'string'
                                ),
                                new OA\Property(
                                    property: 'address',
                                    description: 'Адрес АЗС',
                                    type: 'string'
                                ),
                                new OA\Property(
                                    property: 'latitude',
                                    description: 'Широта',
                                    type: 'number',
                                    format: 'float'
                                ),
                                new OA\Property(
                                    property: 'longitude',
                                    description: 'Долгота',
                                    type: 'number',
                                    format: 'float'
                                ),
                                new OA\Property(
                                    property: 'od_api_id',
                                    description: 'Идентификатор в системе',
                                    type: 'integer'
                                ),
                                new OA\Property(
                                    property: 'fuel_prices',
                                    description: 'Цены на топливо',
                                    type: 'array',
                                    items: new OA\Items(
                                        type: 'object',
                                        properties: [
                                            new OA\Property(
                                                property: 'id',
                                                description: 'Идентификатор цены на топливо',
                                                type: 'integer'
                                            ),
                                            new OA\Property(
                                                property: 'gas_station_id',
                                                description: 'Идентификатор АЗС',
                                                type: 'integer'
                                            ),
                                            new OA\Property(
                                                property: 'fuel_type_id',
                                                description: 'Идентификатор типа топлива',
                                                type: 'integer'
                                            ),
                                            new OA\Property(
                                                property: 'price',
                                                description: 'Цена',
                                                type: 'string'
                                            ),
                                            new OA\Property(
                                                property: 'created_at',
                                                description: 'Дата создания',
                                                type: 'string',
                                                format: 'date-time'
                                            ),
                                            new OA\Property(
                                                property: 'fuel_type',
                                                description: 'Информация о типе топлива',
                                                type: 'object',
                                                properties: [
                                                    new OA\Property(
                                                        property: 'id',
                                                        description: 'Идентификатор типа топлива',
                                                        type: 'integer'
                                                    ),
                                                    new OA\Property(
                                                        property: 'name',
                                                        description: 'Название типа топлива',
                                                        type: 'string'
                                                    ),
                                                    new OA\Property(
                                                        property: 'code',
                                                        description: 'Код типа топлива',
                                                        type: 'string'
                                                    )
                                                ]
                                            )
                                        ]
                                    )
                                )
                            ]
                        )
                    )
                )
            ]
        );
    }
}
