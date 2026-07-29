<?php

namespace Modules\TimetableWidget\Console;

use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\TimetableWidget\Models\Organization;

class UpdateOrganizationsCommand extends Command
{
    //private const ORGANIZATIONS_URL = 'http://5.141.28.74:5509/api/timesheet/GetOrganizations?guid=12a00ca8-cdc2-4574-b552-1b3757cf2634';
    private readonly string $organisationsUrl;

    /**
     * The name and signature of the console command.
     */
    protected $signature = 'timetable:update-organizations';

    /**
     * The console command description.
     */
    protected $description = 'Обновить список организаций сотрудников';

    protected const string DATASET_LOG_CHANEL = 'timetable_good_people';
    protected const string TELEGRAM_LOG_CHANEL = 'telegram_timetable';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
        $this->organisationsUrl = config('services.timetable.organisations_url');
    }

    /**
     * Execute the console command.
     * @throws ConnectionException
     */
    public function handle()
    {
        Context::add('module', 'TimetableWidget');
        $data = Http::acceptJson()->post($this->organisationsUrl, ['GUID' => '12a00ca8-cdc2-4574-b552-1b3757cf2634']);

        if (!$data->ok() || empty($data->body())) {
            Log::channel(static::TELEGRAM_LOG_CHANEL)->error(
                'Ошибка получения данных об организациях',
                [
                    'status_code' => $data->status(),
                ]
            );
            return null;
        }

        $organizations = $data->json();

        foreach ($organizations as $organization) {
            Organization::query()
                ->updateOrCreate(
                    [
                        'global_id' => $organization['global_id'],
                    ],
                    [
                        'name' => $organization['name'],
                        'timesheet_name' => $organization['timesheet_name'],
                    ],
                );
        }

        Log::stack([static::DATASET_LOG_CHANEL])
            ->info(
                "Процесс обновления данных в \"Список организаций сотрудников\" завершён."
            );
    }
}
