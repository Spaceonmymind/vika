<?php

namespace Modules\ActirovkiWidget\Swagger\Docs\Attributes;

use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'ActirovkiWidgetPublic',
    description: 'Публичное API модуля актировок'
)]
#[OA\Tag(
    name: 'ActirovkiWidgetPrivate',
    description: 'Закрытое API модуля актировок '
)]
class Tags
{
}
