<?php

namespace Modules\InformationSystemsWidget\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Log;
use Modules\InformationSystemsWidget\Models\InformationSystem;
use Modules\InformationSystemsWidget\Models\OdDataset;
use Modules\InformationSystemsWidget\OpenDataHandlers\OpenDataHandler;
use SoapClient;

class UpdateOpenDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'information-systems:update-open-data';

    /**
     * The console command description.
     */
    protected $description = 'Обновить справочник информационных систем';

    protected const string DATASET_LOG_CHANEL = 'info_systems_open_data';
    protected const string TELEGRAM_LOG_CHANEL = 'telegram_info_systems';

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
    public function handle(): void
    {
        Context::add('module', 'InformationSystemsWidget');
        $datasetsList = OdDataset::query()
            ->where('is_active', true)
            ->get();

        $options = [
            'stream_context' => stream_context_create([
                'http' => [
                    'header' => [
                        'Accept:application/xml',
                        'Content-Type: application/xml'
                    ],
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:137.0) Gecko/20100101 Firefox/137.0'
                ]
            ]),
            'cache_wsdl' => WSDL_CACHE_NONE,
            'connection_timeout' => 5,
        ];

        foreach ($datasetsList as $dataset) try {
            $client = new SoapClient(
                config('services.it_registry.base_url').
                '/api/integration/passports/',
                $options
            );
            $data = $client->getPassportIS();

            $hash = md5(json_encode($data));

            if (hash_equals($dataset->current_hash ?? '', $hash) && !$dataset->need_update) {
                $this->updateDatasetMetadata($dataset, $hash);
                continue;
            }

            $this->removeOldRecords();

            $classHandler = $dataset->class_handler;
            $this->updateDataset(new $classHandler(), $data, $dataset);

            $this->updateDatasetMetadata($dataset, $hash);
        } catch (\Throwable $e) {
            Log::stack([static::DATASET_LOG_CHANEL, static::TELEGRAM_LOG_CHANEL])->error('Ошибка справочника информационных систем',
                [
                    'dataset_url' => $dataset->url,
                    'class' => __CLASS__,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
        }

        Log::stack([static::DATASET_LOG_CHANEL])
            ->info(
                "Процесс обновления данных в виджете \"Справочник информационных систем\" завершён."
            );
    }

    private function updateDatasetMetadata($dataset, $hash): void
    {
        $dataset->last_update = now();
        $dataset->need_update = false;
        $dataset->current_hash = $hash;
        $dataset->save();
    }

    private function removeOldRecords(): void
    {
        InformationSystem::query()
            ->delete();
    }

    private function updateDataset(OpenDataHandler $handler, object $data, OdDataset $dataset): void
    {
        $handler::handle($data, $dataset);
    }
}
