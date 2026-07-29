<?php

namespace Modules\CultureUgraWidget\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\CultureUgraWidget\Models\CultureUgraWidgetEvent;

class UpdateCultureEvents extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'culture-ugra:update-events';

    /**
     * The console command description.
     */
    protected $description = 'Обновляет информацию о культурных мероприятиях Югры';

    protected const string DATASET_LOG_CHANEL = 'culture_ugra';

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
        Context::add('module', 'CultureUgraWidget');
        try {

            $response = Http::withoutVerifying()->acceptJson()->get(config('services.culture_ugra.base_url').'/api/events/export');
            $data = $response->collect();

        } catch (\Throwable $e) {
            Log::channel(static::DATASET_LOG_CHANEL)->error('Ошибка при получении данных культурных мероприятий. ' . $e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'code' => $e->getCode(),
                'trace' => $e->getTraceAsString(),
            ]);

            return self::FAILURE;
        }


        if ($data->isNotEmpty()) {
            DB::beginTransaction();
            try {
                CultureUgraWidgetEvent::query()->delete();
                foreach ($data as $row) {
                    if (Carbon::parse($row['endDate'])->format('Y-m-d') < now()->format('Y-m-d')) {
                        continue;
                    }
                    CultureUgraWidgetEvent::query()->create([
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'description' => $row['description'],
                        'start_date' => $row['startDate'],
                        'end_date' => $row['endDate'],
                        'organization_name' => $row['organizationName'],
                        'address' => $row['address'],
                        'locality_id' => $row['location'],
                        'buy_link' => $row['buyLink'],
                        'buy_text' => $row['buyText'],
                    ]);

                }

            } catch (\Throwable $e) {
                DB::rollBack();

                Log::channel(static::DATASET_LOG_CHANEL)->error('Ошибка при обновлении культурных мероприятий. ' . $e->getMessage(), [
                    'line' => $e->getLine(),
                    'file' => $e->getFile(),
                    'code' => $e->getCode(),
                    'trace' => $e->getTraceAsString(),
                ]);

                return self::FAILURE;
            }

            DB::commit();

        } else {

            Log::channel(static::DATASET_LOG_CHANEL)->info('Нет данных о культурных мероприятиях', [
                'response_code' => $response->getStatusCode(),
                'response_body' => $response->getBody(),
            ]);

        }
        Log::stack([static::DATASET_LOG_CHANEL])
            ->info(
                "Процесс обновления данных в виджете \"Культура Югры\" завершён."
            );

        return self::SUCCESS;
    }

}
