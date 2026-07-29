<?php

namespace Modules\StopGraffiti\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Models\User;
use Modules\StopGraffiti\Enums\ReportStatus;
use Modules\StopGraffiti\Http\Requests\IndexReportsRequest;
use Modules\StopGraffiti\Http\Requests\UpdateReportRequest;
use Modules\StopGraffiti\Models\Report;
use Modules\StopGraffiti\Models\ReportMedia;
use Modules\StopGraffiti\Services\ReportService;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminReportController
{
    public function __construct(private readonly ReportService $reports) {}

    public function index(IndexReportsRequest $request)
    {
        return $this->reports->paginate($request->validated());
    }

    public function show(Report $report): Report
    {
        return $report->load(['media', 'assignee', 'statusHistory.changedBy']);
    }

    public function update(UpdateReportRequest $request, Report $report): Report
    {
        /** @var User $operator */
        $operator = $request->user();

        return $this->reports->update($report, $request->validated(), $operator);
    }

    public function metadata(): JsonResponse
    {
        return response()->json([
            'statuses' => array_map(
                static fn (ReportStatus $status): array => [
                    'value' => $status->value,
                    'label' => $status->label(),
                ],
                ReportStatus::cases(),
            ),
            'categories' => Report::query()->distinct()->orderBy('category')->pluck('category'),
            'operators' => User::permission('manage_stop_graffiti')->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function downloadMedia(ReportMedia $media): StreamedResponse
    {
        abort_unless($media->archive_status === 'archived' && $media->storage_path, 404);
        abort_unless(Storage::disk('local')->exists($media->storage_path), 404);

        return response()->streamDownload(
            static function () use ($media): void {
                $stream = Storage::disk('local')->readStream($media->storage_path);
                if ($stream === false) {
                    return;
                }
                fpassthru($stream);
                fclose($stream);
            },
            basename($media->storage_path),
            ['Content-Type' => $media->mime_type ?? 'application/octet-stream'],
        );
    }
}
