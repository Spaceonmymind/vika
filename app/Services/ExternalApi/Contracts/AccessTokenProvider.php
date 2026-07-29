<?php

namespace App\Services\ExternalApi\Contracts;

interface AccessTokenProvider
{
    /**
     * Вернуть валидный токен, обновив его при необходимости.
     *
     * @return AccessToken
     */
    public function getValidToken(): AccessToken;

    /**
     * Принудительно обновить токен независимо от кеша (например, после 401).
     *
     * @return AccessToken
     */
    public function refreshToken(): AccessToken;
}
