<?php

namespace App\Swagger\Components;

use OpenApi\Attributes as OA;

#[OA\Parameter(
    parameter: 'IdempotencyKeyHeader',
    name: 'Idempotency-Key',
    description: 'Уникальный ключ идемпотентности UUIDv4',
    in: 'header',
    required: true,
    example: '2ef8dcee-85bc-4b8b-8286-7425d5f46724'
)]
class IdempotencyKeyHeader
{
}
