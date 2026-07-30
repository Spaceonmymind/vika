<?php

namespace Modules\StopGraffiti\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Admin\Models\User;
use Modules\StopGraffiti\Enums\ReportStatus;

class Report extends Model
{
    protected $table = 'stop_graffiti_reports';

    protected $fillable = [
        'external_id',
        'reported_at',
        'max_user_id',
        'max_recipient_id',
        'recipient_is_chat',
        'category',
        'address',
        'comment',
        'status',
        'assigned_to',
        'received_at',
    ];

    protected function casts(): array
    {
        return [
            'reported_at' => 'immutable_datetime',
            'received_at' => 'immutable_datetime',
            'recipient_is_chat' => 'boolean',
            'status' => ReportStatus::class,
        ];
    }

    public function media(): HasMany
    {
        return $this->hasMany(ReportMedia::class);
    }

    public function statusHistory(): HasMany
    {
        return $this->hasMany(ReportStatusHistory::class)->latest('id');
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
