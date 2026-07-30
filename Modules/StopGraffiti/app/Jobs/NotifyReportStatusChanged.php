<?php

namespace Modules\StopGraffiti\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Modules\StopGraffiti\Models\Report;

class NotifyReportStatusChanged implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 8;

    /**
     * @var array<int, int>
     */
    public array $backoff = [10, 30, 60, 120, 300, 600, 1800];

    public function __construct(
        private readonly int $reportId,
        private readonly ?string $comment,
    ) {}

    public function handle(): void
    {
        $callbackUrl = (string) config('services.stop_graffiti.bot_callback_url');
        $callbackToken = (string) config('services.stop_graffiti.bot_callback_token');

        if ($callbackUrl === '' || $callbackToken === '') {
            return;
        }

        $report = Report::query()->findOrFail($this->reportId);

        Http::asJson()
            ->withToken($callbackToken)
            ->timeout(15)
            ->retry(2, 500)
            ->post($callbackUrl, [
                'reportId' => $report->external_id,
                'userId' => $report->max_user_id,
                'recipientId' => $report->max_recipient_id,
                'recipientIsChat' => $report->recipient_is_chat,
                'status' => $report->status->value,
                'statusLabel' => $report->status->label(),
                'comment' => $this->comment,
            ])
            ->throw();
    }
}
