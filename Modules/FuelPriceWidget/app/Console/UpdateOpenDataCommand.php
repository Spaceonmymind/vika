<?php

namespace Modules\FuelPriceWidget\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\FuelPriceWidget\Models\FuelPrice;
use Modules\FuelPriceWidget\Models\GasStation;
use Modules\FuelPriceWidget\Models\OdDataset;
use Modules\FuelPriceWidget\OpenDataHandlers\OpenDataHandler;

class UpdateOpenDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'fuel-cost:update-open-data';

    /**
     * The console command description.
     */
    protected $description = 'Обновить цены на топливо.';

    protected const string DATASET_LOG_CHANEL = 'fuel_price_open_data';
    protected const string TELEGRAM_LOG_CHANEL = 'telegram_fuel';

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
        Context::add('module', 'FuelPriceWidget');
        $datasetsList = OdDataset::query()
            ->where('is_active', true)
            ->get();

        foreach ($datasetsList as $dataset) try {
            $data = Http::acceptJson()->retry(20, 5000)->get($dataset->url);

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

            $this->removeOldRecords($dataset->id);

            $classHandler = $dataset->class_handler;
            $this->updateDataset(new $classHandler(), $data, $dataset);

            $this->updateDatasetMetadata($dataset, $hash);


        } catch (\Throwable $e) {
            Log::stack([static::DATASET_LOG_CHANEL, static::TELEGRAM_LOG_CHANEL])->error('Ошибка при обновлении цен на топливо',
                [
                    'dataset_url' => $dataset->url,
                    'class' => __CLASS__,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
        }

        Log::stack([static::DATASET_LOG_CHANEL])
            ->info(
                "Процесс обновления данных в виджете \"Цены на топливо\" завершён."
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
     * Удалить цены и связные с ними заправки из указанного набора ОД
     * @param int $odApiId
     * @return void
     * @throws \Throwable
     */
    private function removeOldRecords(int $odApiId): void
    {
        DB::transaction(function () use ($odApiId) {

            $gasStations = GasStation::query()
                ->where('od_api_id', $odApiId)
                ->get(['id', 'od_api_id']);

            $gasStationIds = $gasStations->pluck('id');

            FuelPrice::query()
                ->whereIn('gas_station_id', $gasStationIds)
                ->delete();

            GasStation::query()
                ->whereIn('id', $gasStationIds)
                ->delete();
        });
    }

    private function updateDataset(OpenDataHandler $handler, array $data, OdDataset $dataset): void
    {
        $handler::handle($data, $dataset);
    }
}
