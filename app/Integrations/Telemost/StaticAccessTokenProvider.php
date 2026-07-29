<?php

namespace App\Integrations\Telemost;

use App\Services\ExternalApi\Auth\BearerToken;
use App\Services\ExternalApi\Contracts\AccessToken;
use App\Services\ExternalApi\Contracts\AccessTokenProvider;
use Carbon\Carbon;
use Carbon\CarbonInterface;

final readonly class StaticAccessTokenProvider implements AccessTokenProvider
{
    public function __construct(
        private string           $token,
        private ?CarbonInterface $expiresAt = null,
    )
    {
    }

    /**
     * Вернуть валидный токен, обновив его при необходимости.
     *
     * @return AccessToken
     */
    public function getValidToken(): AccessToken
    {
        return $this->makeToken();
    }

    private function makeToken(): AccessToken
    {
        return new BearerToken(
            $this->token,
            $this->expiresAt ?? Carbon::now()->addYear(),
        );
    }

    /**
     * Принудительно обновить токен независимо от кеша (например, после 401).
     *
     * @return AccessToken
     */
    public function refreshToken(): AccessToken
    {
        return $this->makeToken();
    }
}
