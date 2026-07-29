<?php

namespace App\Services\ExternalApi\Contracts;

use Illuminate\Http\Client\Response;

interface ExternalApiClient
{
    /**
     * Отправить запрос во внешний API с автоматической обработкой авторизации.
     *
     * @param string $method
     * @param string $path
     * @param array $options
     * @return Response
     */
    public function request(string $method, string $path, array $options = []): Response;
}
