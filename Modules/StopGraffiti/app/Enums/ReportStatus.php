<?php

namespace Modules\StopGraffiti\Enums;

enum ReportStatus: string
{
    case New = 'new';
    case InProgress = 'in_progress';
    case Completed = 'completed';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::New => 'Новое',
            self::InProgress => 'В работе',
            self::Completed => 'Выполнено',
            self::Rejected => 'Отклонено',
        };
    }
}
