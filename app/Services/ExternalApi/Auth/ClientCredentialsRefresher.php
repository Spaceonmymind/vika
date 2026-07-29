<?php

namespace App\Services\ExternalApi\Auth;

use App\Services\ExternalApi\Contracts\AccessToken;
use App\Services\ExternalApi\Contracts\AccessTokenRefresher;
use App\Services\ExternalApi\Exceptions\TokenRefreshException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Arr;

final readonly class ClientCredentialsRefresher implements AccessTokenRefresher
{
    /**
     * @param PendingRequest $http Базовая конфигурация запросов (таймауты, proxy и т.п.).
     * @param string $tokenUrl Полный URL точки получения токена.
     * @param string $clientId
     * @param string $clientSecret
     * @param string|null $scope Скоупы через пробел, если они требуются.
     */
    public function __construct(
        private PendingRequest $http,
        private string         $tokenUrl,
        private string         $clientId,
        private string         $clientSecret,
        private ?string        $scope = null,
    )
    {
    }

    /**
     * Запросить новый токен у сервера авторизации по настроенному гранту.
     *
     * @return AccessToken
     */
    public function issueToken(): AccessToken
    {
        return $this->requestToken();
    }

    private function requestToken(): AccessToken
    {
        $response = $this->http
            ->asForm()
            ->post($this->tokenUrl, array_filter([
                'grant_type' => 'client_credentials',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'scope' => $this->scope,
            ], static fn($value) => $value !== null));

        try {
            $response->throw();
        } catch (RequestException $exception) {
            throw new TokenRefreshException('Не удалось получить токен: ' . $exception->getMessage(), previous: $exception);
        }

        $payload = $response->json();
        $accessToken = Arr::get($payload, 'access_token');
        $expiresIn = (int)Arr::get($payload, 'expires_in', 0);

        if (!$accessToken || $expiresIn <= 0) {
            throw new TokenRefreshException('Ответ не содержит access_token или корректный expires_in.');
        }

        return BearerToken::fromExpiresIn($accessToken, $expiresIn);
    }

    /**
     * Обновить токен, если текущий истёк или отклонён.
     *
     * @param AccessToken|null $expiredToken
     * @return AccessToken
     */
    public function refresh(?AccessToken $expiredToken = null): AccessToken
    {
        return $this->requestToken();
    }
}
