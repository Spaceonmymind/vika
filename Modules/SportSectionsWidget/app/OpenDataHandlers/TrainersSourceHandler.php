<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Modules\SportSectionsWidget\Models\OdDataset;
use Modules\SportSectionsWidget\Models\Trainer;

class TrainersSourceHandler extends AbstractSourceHandler
{

    protected const array FIELDS = [
        'FIO_TRENERA',
        'KONTAKTNYY_TELEFON',
        'SPORTIVNYY_RAZRYAD_ZVANIE',

        //Не используемые
        'ID',
    ];

    public static function processData(array $data, OdDataset $dataset): void
    {
        $rows = $data['rows'];
        $municipalityId = $dataset->municipality_id;
        Trainer::query()->where('municipality_id', $municipalityId)->delete();

        foreach ($rows as $row) try {
            static::handleRowData($row, $municipalityId);
            self::$rowNumber++;
        } catch (ModelNotFoundException $e) {
            Log::channel(static::DATASET_LOG_CHANEL)->error('processData Error Ошибка при обновлении информации о спортивных секциях',
                [
                    'handler' => static::class,
                    'row' => static::$rowNumber,
                    'dataset_url' => $dataset->url,
                    'error' => $e->getMessage(),
//                    'trace' => $e->getTraceAsString(),
                ]);
//            Log::channel(static::TELEGRAM_LOG_CHANEL)->error($e->getMessage() . ' \n ' . 'URL: ' . $dataset->url);
        }
        if (count(self::$unknownTrainers) > 0) {
            Log::channel(static::TELEGRAM_LOG_CHANEL)->warning("В наборе <a href=\"$dataset->url\">$dataset->description</a> Не найдены тренеры с указанными ФИО:  \n" . implode("\n", self::$unknownTrainers));
            self::$unknownTrainers = [];
        }
        if (count(self::$unknownInns) > 0) {
            Log::channel(static::TELEGRAM_LOG_CHANEL)->warning("В наборе <a href=\"$dataset->url\">$dataset->description</a> Не найдены организации с указанными ИНН:  \n" . implode(", ", self::$unknownInns));
            self::$unknownInns = [];
        }
    }

    protected static function handleRowData(array $row, int $municipalityId): void
    {
        $row = $row['cols'];

        $attributes = [
            'name' => $row['FIO_TRENERA'],
            'phone' => $row['KONTAKTNYY_TELEFON'],
            'category' => $row['SPORTIVNYY_RAZRYAD_ZVANIE'],
            'municipality_id' => $municipalityId,
        ];

        self::createModelWithTrimAttributes(new Trainer, $attributes);
    }
}
