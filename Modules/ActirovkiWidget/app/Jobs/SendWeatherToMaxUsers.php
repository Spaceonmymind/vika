<?php

namespace Modules\ActirovkiWidget\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Chat\Services\Max\Subscriptions\SubscriptionService;

class SendWeatherToMaxUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $userId;
    private string $message;

    /**
     * Create a new job instance.
     */
    public function __construct(int $userId, string $message)
    {
        $this->userId = $userId;
        $this->message = $message;
    }


    /**
     * Execute the job.
     * @throws ConnectionException
     */
    public function handle(): void
    {
        $subService = new SubscriptionService();

        $subService->sendNotificationToMax($this->message, $this->userId);
    }


}
