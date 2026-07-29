<?php

namespace Modules\PhoneBookWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetPeoplesContacts  extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/phonebook/get_peoples_contacts',
            operationId: 'getPeoplesContacts',
            summary: 'Получить контактные данные людей',
            tags: ['PhoneBookWidget'],
            parameters: [
                new OA\Parameter(
                    name: 'fio_or_company',
                    in: 'query',
                    description: 'ФИО или название компании для поиска',
                    required: true,
                    schema: new OA\Schema(type: 'string')
                )
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
                                    description: 'Идентификатор контакта',
                                    type: 'integer'
                                ),
                                new OA\Property(
                                    property: 'fio',
                                    description: 'ФИО',
                                    type: 'string'
                                ),
                                new OA\Property(
                                    property: 'city',
                                    description: 'Город',
                                    type: 'string'
                                ),
                                new OA\Property(
                                    property: 'phone',
                                    description: 'Телефонный номер',
                                    type: 'string'
                                ),
                                new OA\Property(
                                    property: 'email',
                                    description: 'Электронная почта',
                                    type: 'string'
                                ),
                                new OA\Property(
                                    property: 'address',
                                    description: 'Адрес',
                                    type: 'string'
                                ),
                                new OA\Property(
                                    property: 'post',
                                    description: 'Должность',
                                    type: 'string'
                                ),
                                new OA\Property(
                                    property: 'administration_body_name',
                                    description: 'Название органа администрации',
                                    type: 'string'
                                ),
                                new OA\Property(
                                    property: 'management_department',
                                    description: 'Управляющий отдел',
                                    type: 'string'
                                ),
                                new OA\Property(
                                    property: 'od_api_id',
                                    type: 'integer'
                                )
                            ]
                        )
                    )
                )
            ]
        );
    }
}
