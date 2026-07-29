<?php

namespace Modules\KMNSSupportWidget\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\KMNSSupportWidget\Models\KmnsSupportWidgetLifeActivityType;
use Modules\KMNSSupportWidget\Models\KmnsSupportWidgetOdDataset;
use Modules\KMNSSupportWidget\OpenDataHandlers\OpenDataHandler;

class UpdateOpenDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'kmns-support:update-open-data';

    /**
     * The console command description.
     */
    protected $description = 'Обновить Навигатор по услугам для КМНС';

    protected const string DATASET_LOG_CHANEL = 'kmns_support_open_data';
    protected const string TELEGRAM_LOG_CHANEL = 'telegram_kmns_support';

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
        Context::add('module', 'KMNSSupportWidget');
        $datasetsList = KmnsSupportWidgetOdDataset::query()
            ->where('is_active', true)
            ->get();

        foreach ($datasetsList as $dataset) {
            try {
                $data = Http::acceptJson()->get($dataset->url);

                if (!$data->ok() || empty($data->body())) {
                    throw new \Exception('Ошибка получения данных. Статус код: ' . $data->status());
                }

                //Сейчас все ОД возвращают json, если появится другой тип данных, то добавить обработчик
                $data = $data->json();

                $hash = md5(json_encode($data));

                if (!$dataset->need_update && hash_equals($dataset->current_hash ?? '', $hash)) {
                    $this->updateDatasetMetadata($dataset, $hash);
                    continue;
                }

                $this->removeOldRecords();

                $classHandler = $dataset->class_handler;

                if ($this->updateDataset(new $classHandler(), $data, $dataset)) {
                    $this->updateDatasetMetadata($dataset, $hash);
                };


            } catch (\Throwable $e) {
                Log::stack([
                    static::DATASET_LOG_CHANEL,
                ])->error('Ошибка при обновлении мер поддержки предпринимателей',
                    [
                        'dataset_url' => $dataset->url,
                        'class' => __CLASS__,
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                    ]);

                Log::stack([
                    static::TELEGRAM_LOG_CHANEL,
                ])->error('Ошибка при обновлении мер поддержки предпринимателей');
            }
        }

        Log::stack([static::DATASET_LOG_CHANEL])
            ->info(
                "Процесс обновления данных в виджете \"Навигатор по услугам для КМНС\" завершён."
            );
    }

    private function updateDatasetMetadata($dataset, $hash): void
    {
        $dataset->last_update = now();
        $dataset->need_update = false;
        $dataset->current_hash = $hash;
        $dataset->save();
    }

    /**
     * Удалить все меры поддержки it
     * @return void
     */
    private function removeOldRecords(): void
    {
        DB::transaction(function () {
            KmnsSupportWidgetLifeActivityType::query()->delete();
        });

    }

    private function updateDataset(OpenDataHandler $handler, array $data, KmnsSupportWidgetOdDataset $dataset): bool
    {
        return $handler::handle($data, $dataset);
    }
}
