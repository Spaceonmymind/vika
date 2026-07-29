<?php

namespace App\Listeners;

use Illuminate\Console\Events\ScheduledTaskStarting;
use Stringable;

class ScheduleStarting
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ScheduledTaskStarting $event): void
    {
        $event->task->thenWithOutput(function (Stringable $output) {
            echo "\n" . $output;
        });
    }
}
