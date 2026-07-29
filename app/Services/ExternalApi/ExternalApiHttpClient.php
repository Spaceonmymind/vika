<?php

namespace App\Services\ExternalApi;

use App\Services\ExternalApi\Contracts\AccessToken;
use App\Services\ExternalApi\Contracts\AccessTokenProvider;
use App\Services\ExternalApi\Contracts\ExternalApiClient;
use App\Services\ExternalApi\Contracts\HttpTransport;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;

final readonly class ExternalApiHttpClient implements ExternalApiClient
{
    /**
     * @param HttpTransport $transport Транспорт, отвечающий за отправку запросов.
     * @param AccessTokenProvider $tokens Провайдер токенов с автоподдержкой refresh.
     * @param string $baseUrl Базовый URL внешнего сервиса.
     */
    public function __construct(
        private HttpTransport       $transport,
        private AccessTokenProvider $tokens,
        private string              $baseUrl,
    )
    {
    }

    /**
     * Отправить запрос во внешний API с автоматической обработкой авторизации.
     *
     * @param string $method
     * @param string $path
     * @param array $options
     * @return Response
     */
    public function request(string $method, string $path, array $options = []): Response
    {
        $url = $this->buildUrl($path);
        $token = $this->tokens->getValidToken();

        $response = $this->sendWithToken($method, $url, $options, $token);

        if ($response->status() !== 401) {
            return $response;
        }

        $freshToken = $this->tokens->refreshToken();

        return $this->sendWithToken($method, $url, $options, $freshToken);
    }

    private function buildUrl(string $path): string
    {
        return rtrim($this->baseUrl, '/') . '/' . ltrim($path, '/');
    }

    private function sendWithToken(string $method, string $url, array $options, AccessToken $token): Response
    {
        $headers = Arr::get($options, 'headers', []);
        $headers['Authorization'] = 'OAuth ' . $token->token();

        $preparedOptions = $options;
        $preparedOptions['headers'] = $headers;

        return $this->transport->send($method, $url, $preparedOptions);
    }
}
