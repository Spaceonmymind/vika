<?php

namespace App\Services\ExternalApi\Auth;

use App\Services\ExternalApi\Contracts\AccessToken;
use App\Services\ExternalApi\Contracts\AccessTokenProvider;
use App\Services\ExternalApi\Contracts\AccessTokenRefresher;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Contracts\Cache\Repository as CacheRepository;

final readonly class CachedAccessTokenProvider implements AccessTokenProvider
{
    /**
     * @param AccessTokenRefresher $refresher
     * @param CacheRepository $cache
     * @param string $cacheKey
     * @param int $leewaySeconds Сдвиг времени в секундах для досрочного обновления токена.
     */
    public function __construct(
        private AccessTokenRefresher $refresher,
        private CacheRepository      $cache,
        private string               $cacheKey,
        private int                  $leewaySeconds = 30,
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
        $cached = $this->cache->get($this->cacheKey);
        $now = Carbon::now();

        if ($cached instanceof AccessToken && !$cached->isExpired($this->withLeeway($now))) {
            return $cached;
        }

        return $this->refreshTokenWithPrevious($cached instanceof AccessToken ? $cached : null);
    }

    private function withLeeway(CarbonInterface $now): CarbonInterface
    {
        return $now->copy()->addSeconds($this->leewaySeconds);
    }

    /**
     * Расширенный вариант обновления с учётом предыдущего токена.
     *
     * @param AccessToken|null $previousToken
     * @return AccessToken
     */
    private function refreshTokenWithPrevious(?AccessToken $previousToken = null): AccessToken
    {
        $token = $this->refresher->refresh($previousToken);
        $this->store($token);

        return $token;
    }

    private function store(AccessToken $token): void
    {
        $now = Carbon::now();
        $secondsToLive = (int)($now->diffInSeconds($token->expiresAt(), false) - $this->leewaySeconds);

        if ($secondsToLive < 1) {
            return;
        }

        $this->cache->put($this->cacheKey, $token, $secondsToLive);
    }

    /**
     * Принудительно обновить токен независимо от кеша (например, после 401).
     *
     * @return AccessToken
     */
    public function refreshToken(): AccessToken
    {
        return $this->refreshTokenWithPrevious();
    }
}
