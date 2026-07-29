<?php

namespace App\Services\ExternalApi\Transport;

use App\Services\ExternalApi\Contracts\HttpTransport;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

final readonly class LaravelHttpTransport implements HttpTransport
{
    public function __construct(private PendingRequest $request)
    {
    }

    /**
     * Выполнить HTTP-запрос с указанным методом, адресом и опциями.
     *
     * @param string $method
     * @param string $url
     * @param array $options
     * @return Response
     */
    public function send(string $method, string $url, array $options = []): Response
    {
        return $this->request->send($method, $url, $options);
    }
}
