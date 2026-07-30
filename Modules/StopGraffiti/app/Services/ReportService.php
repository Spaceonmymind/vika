<?php

namespace Modules\StopGraffiti\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Models\User;
use Modules\StopGraffiti\Enums\ReportStatus;
use Modules\StopGraffiti\Jobs\ArchiveReportMedia;
use Modules\StopGraffiti\Jobs\NotifyReportStatusChanged;
use Modules\StopGraffiti\Models\Report;

class ReportService
{
    /**
     * @param array{
     *     id: string,
     *     createdAt: string,
     *     userId: int,
     *     recipientId: int,
     *     recipientIsChat: bool,
     *     category: string,
     *     address: string,
     *     comment?: string|null,
     *     media: array<int, array{type: string, payloadJson: string}>
     * } $data
     */
    public function receive(array $data): Report
    {
        return DB::transaction(function () use ($data): Report {
            $report = Report::query()->firstOrCreate(
                ['external_id' => $data['id']],
                [
                    'reported_at' => $data['createdAt'],
                    'max_user_id' => $data['userId'],
                    'max_recipient_id' => $data['recipientId'],
                    'recipient_is_chat' => $data['recipientIsChat'],
                    'category' => $data['category'],
                    'address' => $data['address'],
                    'comment' => $data['comment'] ?? null,
                    'status' => ReportStatus::New,
                    'received_at' => now(),
                ],
            );

            if ($report->wasRecentlyCreated) {
                $mediaRecords = $report->media()->createMany(array_map(
                    static fn (array $media): array => [
                        'type' => $media['type'],
                        'payload' => json_decode($media['payloadJson'], true, flags: JSON_THROW_ON_ERROR),
                    ],
                    $data['media'],
                ));

                foreach ($mediaRecords as $media) {
                    ArchiveReportMedia::dispatch($media->id)
                        ->afterCommit()
                        ->onQueue('stop-graffiti-media');
                }

                $report->statusHistory()->create([
                    'from_status' => null,
                    'to_status' => ReportStatus::New,
                    'comment' => 'Обращение получено от бота MAX.',
                ]);
            }

            return $report->load(['media', 'assignee', 'statusHistory.changedBy']);
        });
    }

    /**
     * @param  array{query?: string|null, status?: string|null, category?: string|null, assigned_to?: int|null, per_page?: int|null}  $filters
     */
    public function paginate(array $filters): LengthAwarePaginator
    {
        return Report::query()
            ->with(['media', 'assignee'])
            ->when($filters['query'] ?? null, function ($query, string $search): void {
                $query->where(function ($query) use ($search): void {
                    $query
                        ->where('external_id', 'like', "%{$search}%")
                        ->orWhere('address', 'like', "%{$search}%")
                        ->orWhere('comment', 'like', "%{$search}%");
                });
            })
            ->when($filters['status'] ?? null, fn ($query, string $status) => $query->where('status', $status))
            ->when($filters['category'] ?? null, fn ($query, string $category) => $query->where('category', $category))
            ->when(array_key_exists('assigned_to', $filters), fn ($query) => $query->where('assigned_to', $filters['assigned_to']))
            ->latest('reported_at')
            ->paginate($filters['per_page'] ?? 15);
    }

    /**
     * @param  array{status?: string, assigned_to?: int|null, comment?: string|null}  $data
     */
    public function update(Report $report, array $data, User $operator): Report
    {
        return DB::transaction(function () use ($report, $data, $operator): Report {
            $previousStatus = $report->status;

            $report->fill([
                'status' => $data['status'] ?? $report->status,
                'assigned_to' => array_key_exists('assigned_to', $data)
                    ? $data['assigned_to']
                    : $report->assigned_to,
            ])->save();

            if (isset($data['status']) && $previousStatus->value !== $data['status']) {
                $report->statusHistory()->create([
                    'from_status' => $previousStatus,
                    'to_status' => $data['status'],
                    'comment' => $data['comment'] ?? null,
                    'changed_by' => $operator->id,
                ]);

                NotifyReportStatusChanged::dispatch(
                    $report->id,
                    $data['comment'] ?? null,
                )->afterCommit()->onQueue('stop-graffiti-notifications');
            }

            return $report->load(['media', 'assignee', 'statusHistory.changedBy']);
        });
    }
}
