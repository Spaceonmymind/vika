<?php

namespace Modules\StopGraffiti\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\StopGraffiti\Models\ReportMedia;
use RuntimeException;

class ArchiveReportMedia implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private const int MAX_FILE_SIZE = 262_144_000;

    public int $tries = 8;

    /**
     * @var array<int, int>
     */
    public array $backoff = [10, 30, 60, 120, 300, 600, 1800];

    public function __construct(private readonly int $mediaId) {}

    public function handle(): void
    {
        $media = ReportMedia::query()->findOrFail($this->mediaId);

        if ($media->archive_status === 'archived') {
            return;
        }

        $url = $media->payload['url'] ?? null;
        if (! is_string($url) || ! $this->isAllowedUrl($url)) {
            $this->failMedia($media, 'MAX media URL is missing or its host is not allowed.');

            return;
        }

        $temporaryPath = tempnam(sys_get_temp_dir(), 'stop-graffiti-');
        if ($temporaryPath === false) {
            throw new RuntimeException('Unable to create a temporary media file.');
        }

        try {
            $response = Http::timeout(120)
                ->connectTimeout(10)
                ->withHeaders(['Accept' => 'image/*,video/*,application/octet-stream'])
                ->withOptions([
                    'sink' => $temporaryPath,
                    'progress' => static function (
                        int $downloadTotal,
                        int $downloadedBytes,
                    ): void {
                        if ($downloadTotal > self::MAX_FILE_SIZE || $downloadedBytes > self::MAX_FILE_SIZE) {
                            throw new RuntimeException('MAX media file exceeds the 250 MB archive limit.');
                        }
                    },
                ])
                ->get($url)
                ->throw();

            $fileSize = filesize($temporaryPath);
            if ($fileSize === false || $fileSize > self::MAX_FILE_SIZE) {
                throw new RuntimeException('Unable to determine MAX media size or archive limit exceeded.');
            }

            $mimeType = strtolower(trim(explode(';', $response->header('Content-Type', 'application/octet-stream'))[0]));
            if (! $this->isAllowedMimeType($mimeType)) {
                throw new RuntimeException("Unsupported MAX media type: {$mimeType}.");
            }

            $extension = $this->extensionFor($mimeType);
            $storagePath = "stop-graffiti/{$media->report_id}/".Str::uuid().".{$extension}";
            $stream = fopen($temporaryPath, 'rb');
            if (
                $stream === false
                || ! Storage::disk('local')->put($storagePath, $stream, ['visibility' => 'public'])
            ) {
                throw new RuntimeException('Unable to write MAX media to private storage.');
            }
            fclose($stream);
            $this->makeReadableByPhpFpm($storagePath);

            $media->update([
                'archive_status' => 'archived',
                'storage_path' => $storagePath,
                'mime_type' => $mimeType,
                'size' => $fileSize,
                'archive_error' => null,
            ]);
        } finally {
            @unlink($temporaryPath);
        }
    }

    public function failed(?\Throwable $exception): void
    {
        $media = ReportMedia::query()->find($this->mediaId);
        if ($media instanceof ReportMedia) {
            $this->failMedia($media, $exception?->getMessage() ?? 'Unknown media archive error.');
        }
    }

    private function isAllowedUrl(string $url): bool
    {
        $parts = parse_url($url);
        $allowedHosts = config('services.stop_graffiti.media_allowed_hosts', []);

        return ($parts['scheme'] ?? null) === 'https'
            && isset($parts['host'])
            && in_array(strtolower($parts['host']), array_map('strtolower', $allowedHosts), true);
    }

    private function isAllowedMimeType(string $mimeType): bool
    {
        return str_starts_with($mimeType, 'image/')
            || str_starts_with($mimeType, 'video/')
            || in_array($mimeType, ['application/pdf', 'application/octet-stream'], true);
    }

    private function extensionFor(string $mimeType): string
    {
        return match ($mimeType) {
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
            'image/gif' => 'gif',
            'video/mp4' => 'mp4',
            'video/webm' => 'webm',
            'application/pdf' => 'pdf',
            default => 'bin',
        };
    }

    private function makeReadableByPhpFpm(string $storagePath): void
    {
        $disk = Storage::disk('local');
        $absolutePath = $disk->path($storagePath);
        $diskRoot = rtrim($disk->path(''), DIRECTORY_SEPARATOR);

        if (! chmod($absolutePath, 0644)) {
            throw new RuntimeException('Unable to set archived media file permissions.');
        }

        $directory = dirname($absolutePath);
        while (str_starts_with($directory, $diskRoot)) {
            if (! chmod($directory, 0755)) {
                throw new RuntimeException('Unable to set archived media directory permissions.');
            }

            if ($directory === $diskRoot) {
                break;
            }

            $directory = dirname($directory);
        }
    }

    private function failMedia(ReportMedia $media, string $message): void
    {
        $media->update([
            'archive_status' => 'failed',
            'archive_error' => Str::limit($message, 2000),
        ]);
    }
}
