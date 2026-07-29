<?php

namespace Modules\InformationSystemsWidget\OpenDataHandlers;

use Exception;
use Illuminate\Support\Facades\Log;
use Modules\InformationSystemsWidget\Models\OdDataset;

abstract class AbstractSourceHandler implements OpenDataHandler
{
    protected const string DATASET_LOG_CHANEL = 'info_systems_open_data';
    protected const string TELEGRAM_LOG_CHANEL = 'telegram_info_systems';
    protected static int $rowNumber = 0;

    /**
     * @throws Exception
     */
    public static function handle(object $data, OdDataset $dataset): void
    {
        try {
            static::processData($data, $dataset);
        } catch (\Throwable $e) {
            Log::stack([static::DATASET_LOG_CHANEL, static::TELEGRAM_LOG_CHANEL])->error('od_handler_error Ошибка при обновлении справочника информационных систем',
                [
                    'handler' => static::class,
                    'row' => static::$rowNumber,
                    'dataset_url' => $dataset->url,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
        }
    }

    abstract protected static function processData(object $data, OdDataset $dataset);
}
