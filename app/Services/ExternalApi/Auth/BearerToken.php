<?php

namespace App\Services\ExternalApi\Auth;

use App\Services\ExternalApi\Contracts\AccessToken;
use Carbon\Carbon;
use Carbon\CarbonInterface;

final readonly class BearerToken implements AccessToken
{
    public function __construct(
        private string          $token,
        private CarbonInterface $expiresAt,
    )
    {
    }

    /**
     * Создать токен на основании expires_in.
     *
     * @param string $token
     * @param int $expiresInSeconds
     * @param CarbonInterface|null $issuedAt
     * @return self
     */
    public static function fromExpiresIn(string $token, int $expiresInSeconds, ?CarbonInterface $issuedAt = null): self
    {
        $issuedAt ??= Carbon::now();

        return new self($token, $issuedAt->copy()->addSeconds($expiresInSeconds));
    }

    /**
     * Исходный токен для заголовка Authorization.
     *
     * @return string
     */
    public function token(): string
    {
        return $this->token;
    }

    /**
     * Момент истечения срока действия токена.
     *
     * @return CarbonInterface
     */
    public function expiresAt(): CarbonInterface
    {
        return $this->expiresAt;
    }

    /**
     * Проверить, истек ли токен на указанное время.
     *
     * @param CarbonInterface|null $now
     * @return bool
     */
    public function isExpired(?CarbonInterface $now = null): bool
    {
        $now ??= Carbon::now();

        return $now->greaterThanOrEqualTo($this->expiresAt);
    }
}
