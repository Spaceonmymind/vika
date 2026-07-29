<?php

namespace Modules\ActirovkiWidget\Dto;

use Modules\ActirovkiWidget\Enums\ActirovkaStatus;
use Modules\ActirovkiWidget\Models\Row;

final class ActirovkaDto
{
    public function __construct(
        public string          $schoolShift,
        public ActirovkaStatus $status,
        public string          $message,
        public ?Row            $row = null,
    )
    {
    }

    public static function pending(string $shift, string $msg): self
    {
        return new self($shift, ActirovkaStatus::Pending, $msg);
    }

    public static function announced(string $shift, string $msg, Row $row): self
    {
        return new self($shift, ActirovkaStatus::Announced, $msg, $row);
    }

    public static function notAnnounced(string $shift, string $msg): self
    {
        return new self($shift, ActirovkaStatus::NotAnnounced, $msg);
    }
}
