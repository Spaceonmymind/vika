<?php

namespace App\Services\ExternalApi\Contracts;

use Illuminate\Http\Client\Response;

interface HttpTransport
{
    /**
     * Выполнить HTTP-запрос с указанным методом, адресом и опциями.
     *
     * Опции совпадают с контрактом HTTP-клиента Laravel (headers, query, json и т.д.).
     *
     * @param string $method
     * @param string $url
     * @param array $options
     * @return Response
     */
    public function send(string $method, string $url, array $options = []): Response;
}
