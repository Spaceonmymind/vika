<?php

namespace Modules\StopGraffiti\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\URL;

class ReportMedia extends Model
{
    protected $table = 'stop_graffiti_report_media';

    protected $fillable = [
        'type',
        'payload',
        'archive_status',
        'storage_path',
        'mime_type',
        'size',
        'archive_error',
    ];

    protected $hidden = ['payload', 'storage_path', 'archive_error'];

    protected $appends = ['download_url'];

    protected function casts(): array
    {
        return ['payload' => 'array'];
    }

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }

    public function getDownloadUrlAttribute(): ?string
    {
        if ($this->archive_status !== 'archived') {
            return null;
        }

        return URL::temporarySignedRoute(
            'api.stop-graffiti.media',
            now()->addMinutes(30),
            ['mediaId' => $this->getKey()],
            absolute: false,
        );
    }
}
