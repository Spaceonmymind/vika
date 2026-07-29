<?php

namespace Modules\ITSupportWidget\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\ITSupportWidget\Models\ItSupportWidgetMeasure;
use Modules\ITSupportWidget\Models\ItSupportWidgetOdDataset;
use Modules\ITSupportWidget\OpenDataHandlers\OpenDataHandler;

class UpdateOpenDataCommand extends Command
{
    protected const string DATASET_LOG_CHANEL = 'it_support_open_data';
    protected const string TELEGRAM_LOG_CHANEL = 'telegram_it_support';
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'it-support:update-open-data';
    /**
     * The console command description.
     */
    protected $description = 'Обновить меры поддержки предпринимателей';

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
        Context::add('module', 'ITSupportWidget');

        $datasetsList = ItSupportWidgetOdDataset::query()
            ->where('is_active', true)
            ->get();

        $successfullyFinished = true;

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
                } else {
                    $successfullyFinished = false;
                }

            } catch (\Throwable $e) {
                $successfullyFinished = false;
                Log::stack([
                    static::DATASET_LOG_CHANEL,
                ])->error('Ошибка при обновлении мер поддержки it',
                    [
                        'dataset_url' => $dataset->url,
                        'class' => __CLASS__,
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                    ]);

                Log::stack([
                    static::TELEGRAM_LOG_CHANEL,
                ])->error('Ошибка при обновлении мер поддержки it');
            }
        }
        if ($successfullyFinished) {
            Log::stack([static::DATASET_LOG_CHANEL])
                ->info(
                    "Процесс обновления данных в виджете \"Меры поддержки it\" успешно завершен.",
                );
        }
    }

    private function updateDatasetMetadata(
        $dataset,
        $hash,
    ): void {
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
            ItSupportWidgetMeasure::query()->delete();
        });

    }

    private function updateDataset(
        OpenDataHandler $handler,
        array $data,
        ItSupportWidgetOdDataset $dataset,
    ): bool {
        return $handler::handle($data, $dataset);
    }
}
