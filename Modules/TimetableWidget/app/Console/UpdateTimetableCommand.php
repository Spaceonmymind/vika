<?php

namespace Modules\TimetableWidget\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Log;
use Modules\TimetableWidget\Jobs\UpdateEmployeesAndTimetables;
use Modules\TimetableWidget\Models\Organization;

class UpdateTimetableCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'timetable:update';

    /**
     * The console command description.
     */
    protected $description = 'Обновить график работы сотрудников';

    protected const string DATASET_LOG_CHANEL = 'timetable_good_people';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Context::add('module', 'TimetableWidget');
        $organizations = Organization::all();

        foreach ($organizations as $organization) {
            try {
                UpdateEmployeesAndTimetables::dispatch($organization->id, $organization->global_id, $organization->name)->onQueue('timetable');

                $organization->updated_at = Carbon::now();
                $organization->save();
            } catch (\Throwable $e) {
                Log::channel(static::DATASET_LOG_CHANEL)->error(
                    'Ошибка при обновлении табеля',
                    [
                        'organization_id' => $organization->global_id ?? null,
                        'class' => __CLASS__,
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                    ]
                );
            }
        }

        Log::stack([static::DATASET_LOG_CHANEL])
            ->info(
                "Процесс обновления данных в виджете \"График работы сотрудников\" завершён."
            );
    }
}
