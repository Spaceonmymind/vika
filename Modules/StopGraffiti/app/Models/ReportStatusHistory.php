<?php

namespace Modules\StopGraffiti\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Admin\Models\User;
use Modules\StopGraffiti\Enums\ReportStatus;

class ReportStatusHistory extends Model
{
    public const ?string UPDATED_AT = null;

    protected $table = 'stop_graffiti_report_status_history';

    protected $fillable = ['from_status', 'to_status', 'comment', 'changed_by'];

    protected function casts(): array
    {
        return [
            'from_status' => ReportStatus::class,
            'to_status' => ReportStatus::class,
        ];
    }

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }

    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
