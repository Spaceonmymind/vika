<?php

namespace Modules\ActirovkiWidget\Swagger\Docs\Attributes\RowController;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute]
class ExportCsv extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/widget/actirovki/rows/export-csv',
            operationId: 'exportCsvRowActirovkiWidget',
            summary: 'Получить список актировок в CSV',
            tags: ['ActirovkiWidgetPrivate'],
            parameters: [
                new OA\Parameter(
                    name: 'filter[city_id]',
                    description: 'ID населенного пункта',
                    in: 'query',
                    schema: new OA\Schema(type: 'integer'),
                    example: 28
                ),
                new OA\Parameter(
                    name: 'filter[date_from]',
                    description: 'Дата начала диапазона',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'string', format: 'date', example: '01.01.2025'),
                ),
                new OA\Parameter(
                    name: 'filter[date_to]',
                    description: 'Дата окончания диапазона',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'string', format: 'date', example: '30.04.2025'),
                ),
                new OA\Parameter(
                    name: 'filter[school_shift]',
                    description: 'Смена (1 или 2)',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'integer', enum: [1, 2], example: 1),
                ),
                new OA\Parameter(
                    name: 'filter[school_class]',
                    description: 'Класс, по который объявлена актировка',
                    in: 'query',
                    required: false,
                    schema: new OA\Schema(type: 'integer', enum: [4, 8, 11], example: 11),
                ),
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: "CSV-файл с данными",
                    content: new OA\MediaType(
                        mediaType: "text/csv; charset=UTF-8",
                        schema: new OA\Schema(
                            description: "Поток CSV",
                            type: "string",
                            format: "binary"
                        )
                    )
                ),
            ],
        );
    }
}
