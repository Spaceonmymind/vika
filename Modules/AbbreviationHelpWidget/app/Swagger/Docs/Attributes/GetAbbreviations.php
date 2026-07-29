<?php

namespace Modules\AbbreviationHelpWidget\Swagger\Docs\Attributes;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class GetAbbreviations  extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/abbreviation_help/get_abbreviations',
            operationId: 'getAbbreviationHelpWidgetAbbreviations',
            summary: 'Получить расшифровку аббревиатур',
            tags: ['AbbreviationHelpWidget'],
            parameters: [
                new OA\Parameter(
                    name: 'name',
                    in: 'query',
                    description: 'Короткая форма аббревиатуры',
                    required: false,
                    example:'адб'
                )
            ],
            responses: [
                new OA\Response(
                    response: '200',
                    description: 'Successful operation',
                    content: new OA\JsonContent(
                        type: 'array',
                        items: new OA\Items(
                            type: 'object',
                            description: 'Найденные аббривеатуры',
                            properties: [
                                new OA\Property(
                                    property: 'id',
                                    description: 'Идентификатор аббривеатуры',
                                    type: 'integer',
                                    example: 17
                                ),
                                new OA\Property(
                                    property: 'abbreviation',
                                    description: 'Сама аббривеатура',
                                    type: 'string',
                                    example: 'АДБ'
                                ),
                                new OA\Property(
                                    property: 'decoding',
                                    description: 'Расшифровка аббривеатуры',
                                    type: 'string',
                                    example: 'Администратор доходов бюджета'
                                ),
                                new OA\Property(
                                    property: 'description',
                                    description: 'Описание аббривеатуры',
                                    type: 'string',
                                    example: 'Орган государственной власти (государственный орган), орган местного самоуправления, орган местной администрации, орган управления государственным внебюджетным фондом, Центральный банк Российской Федерации, казённое учреждение, осуществляющие в соответствии с законодательством Российской Федерации контроль за правильностью исчисления, полнотой и своевременностью уплаты, начисление, учёт, взыскание и принятие решений о возврате (зачёте) излишне уплаченных (взысканных) платежей, пеней и штрафов по ним, являющихся доходами бюджетов бюджетной системы Российской Федерации, если иное не установлено Бюджетным кодексом Российской Федерации'                            ),
                            ]
                        ),
                    )
                )
            ]
        );
    }
}
