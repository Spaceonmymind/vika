<?php

namespace Modules\Esia\Dto;

final class CasTicketValidationResult
{
    public function __construct(
        public bool    $ok,
        public ?string $snils = null,
        public ?string $errorCode = null,
        public ?string $errorMessage = null
    )
    {
    }

    public static function success(string $snils): self
    {
        return new self(true, $snils, null, null);
    }

    public static function failure(string $code, string $msg): self
    {
        return new self(false, null, $code, $msg);
    }
}
