<?php

namespace App\Services\ExternalApi\Contracts;

use Carbon\CarbonInterface;

interface AccessToken
{
    /**
     * Исходный токен для заголовка Authorization.
     *
     * @return string
     */
    public function token(): string;

    /**
     * Момент истечения срока действия токена.
     *
     * @return CarbonInterface
     */
    public function expiresAt(): CarbonInterface;

    /**
     * Проверить, истек ли токен на указанное время.
     *
     * @param CarbonInterface|null $now
     * @return bool
     */
    public function isExpired(?CarbonInterface $now = null): bool;
}
