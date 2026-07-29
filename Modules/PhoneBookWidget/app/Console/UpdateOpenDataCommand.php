<?php

namespace Modules\PhoneBookWidget\Console;

use Flowgistics\XML\XML;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\PhoneBookWidget\Models\OdDataset;
use Modules\PhoneBookWidget\Models\PhonebookRecord;
use Modules\PhoneBookWidget\OpenDataHandlers\OpenDataHandler;

class UpdateOpenDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'phonebook:update-open-data';

    /**
     * The console command description.
     */
    protected $description = 'Обновить телефонный справочник';

    protected const string DATASET_LOG_CHANEL = 'phonebook_open_data';
    protected const string TELEGRAM_LOG_CHANEL = 'telegram_phonebook';

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
        Context::add('module', 'PhoneBookWidget');
        $datasetsList = OdDataset::query()
            ->where('is_active', true)
            ->get();

        foreach ($datasetsList as $dataset) try {
            $data = Http::acceptJson()->retry(20, 5000)->get($dataset->url);

            $this->checkRequestSuccess($data);

            switch ($dataset->data_type) {
                case 'json':
                    $data = $data->json();
                    break;
                case 'xml':
                    $data = XML::import($data)->toArray();
                    break;
                default:
                    continue 2;
            }

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
            Log::stack([static::DATASET_LOG_CHANEL, static::TELEGRAM_LOG_CHANEL])->error('Ошибка при обновлении телефонного справочника',
                [
                    'dataset_url' => $dataset->url,
                    'class' => __CLASS__,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
        }
        DB::statement('OPTIMIZE TABLE phone_book_widget_phonebook_records;');
        Log::stack([static::DATASET_LOG_CHANEL])
            ->info(
                "Процесс обновления данных в виджете \"Телефонный справочник\" завершён."
            );
    }

    /**
     * @throws \Exception
     */
    private function checkRequestSuccess($data): void
    {
        if (!$data->ok() || empty($data->body()) || !empty($data->json()['error'])) {
            $errorText = 'Ошибка получения данных. Статус код: ' . $data->status();
            if (!empty($data->json()['error'])) {
                $errorText .= ' errorText: ' . $data->json()['errorText'];
            }

            throw new \Exception($errorText);
        }
    }

    private function updateDatasetMetadata($dataset, $hash): void
    {
        $dataset->last_update = now();
        $dataset->need_update = false;
        $dataset->current_hash = $hash;
        $dataset->save();
    }

    private function removeOldRecords($odApiId): void
    {
        PhonebookRecord::query()
            ->where('od_api_id', $odApiId)
            ->delete();
    }

    private function updateDataset(OpenDataHandler $handler, array $data, OdDataset $dataset): void
    {
        $handler::handle($data, $dataset);
    }
}
