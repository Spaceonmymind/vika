<?php

namespace App\Services\ExternalApi\Contracts;

interface AccessTokenRefresher
{
    /**
     * Запросить новый токен у сервера авторизации по настроенному гранту.
     *
     * @return AccessToken
     */
    public function issueToken(): AccessToken;

    /**
     * Обновить токен, если текущий истёк или отклонён.
     *
     * @param AccessToken|null $expiredToken
     * @return AccessToken
     */
    public function refresh(?AccessToken $expiredToken = null): AccessToken;
}
