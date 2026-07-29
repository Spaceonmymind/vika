<?php

namespace Modules\DistrictSearchWidget\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetOdDataset;
use Modules\DistrictSearchWidget\OpenDataHandlers\OpenDataHandler;

class UpdateDatasets extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'districts-search:update-open-data';

    /**
     * The console command description.
     */
    protected $description = 'Обновить информацию об участках.';

    protected const string DATASET_LOG_CHANEL = 'districts_open_data';

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
        Context::add('module', 'DistrictSearchWidget');
        $datasetsList = DistrictSearchWidgetOdDataset::query()
            ->orderBy('dataset_type_id')
            ->where('is_active', true)
            ->get();


        foreach ($datasetsList as $dataset) try {
            $data = Http::acceptJson()->get($dataset->url);

            if (!$data->ok() || empty($data->body())) {
                throw new \Exception('Ошибка получения данных. Статус код: ' . $data->status());
            }

            //Сейчас все ОД возвращают json, если появится другой тип данных, то добавить обработчик
            $data = $data->json();

            $hash = md5(json_encode($data));

            if (hash_equals($dataset->current_hash ?? '', $hash) && !$dataset->need_update) {
                $this->updateDatasetMetadata($dataset, $hash);
                continue;
            }


            $classHandler = $dataset->class_handler;
            $this->updateDataset(new $classHandler(), $data, $dataset);

            $this->updateDatasetMetadata($dataset, $hash);

        } catch (\Throwable $e) {
            Log::channel(static::DATASET_LOG_CHANEL)->error('Ошибка при обновлении медицинских участков',
                [
                    'dataset_url' => $dataset->url,
                    'class' => __CLASS__,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
        }

        Log::stack([static::DATASET_LOG_CHANEL])
            ->info(
                "Процесс обновления данных в виджете \"Медицинские участки\" завершён."
            );
    }

    private function updateDatasetMetadata($dataset, $hash): void
    {
        $dataset->last_update = now();
        $dataset->need_update = false;
        $dataset->current_hash = $hash;
        $dataset->save();
    }


    private function updateDataset(OpenDataHandler $handler, array $data, DistrictSearchWidgetOdDataset $dataset): void
    {
        $handler::handle($data, $dataset);
    }
}
