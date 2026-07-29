<?php

namespace Modules\KMNSSupportWidget\OpenDataHandlers;

use Exception;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\KMNSSupportWidget\Models\KmnsSupportWidgetOdDataset;

abstract class AbstractSourceHandler implements OpenDataHandler
{
    protected const array FIELDS = [];
    protected const string DATASET_LOG_CHANEL = 'kmns_support_open_data';
    protected const string TELEGRAM_LOG_CHANEL = 'telegram_kmns_support';
    protected static int $rowNumber = 0;

    /**
     * Метод всяких проверок у датасета, по идее не должен меняться у потомков
     * @throws Exception
     */
    public static function handle(array $data, KmnsSupportWidgetOdDataset $dataset): bool
    {
        [$hasNewFields, $newFields] = static::hasNewFields($data);

        if ($hasNewFields) {
            Log::stack([static::DATASET_LOG_CHANEL, static::TELEGRAM_LOG_CHANEL])
                ->info(
                    "В наборе открытых данных \"$dataset->description\"  были обнаружены новые поля",
                    ['newFields' => $newFields, 'dataSet' => $dataset],
                );
        }

        [$hasValidStructure, $validationErrors] = static::hasValidStructure($data);

        if (!$hasValidStructure) {
            Log::stack([static::DATASET_LOG_CHANEL])
                ->error(
                    "В наборе открытых данных \"$dataset->description\" были обнаружены ошибки валидации",
                    ['errors' => $validationErrors, 'dataSet' => $dataset],
                );
            Log::stack([static::TELEGRAM_LOG_CHANEL])
                ->error(
                    "В наборе открытых данных \"$dataset->description\" были обнаружены ошибки валидации"
                );
            return false;

            //throw new Exception('В наборе открытых данных "' . $dataset->description . '" были обнаружены ошибки валидации');
        }
        try {
            static::processData($data, $dataset);
        } catch (\Throwable $e) {

            Log::stack([static::DATASET_LOG_CHANEL])->error('od_handler_error Ошибка при обновлении мер поддержки КМНС',
                [
                    'handler' => static::class,
                    'row' => static::$rowNumber,
                    'dataset_url' => $dataset->url,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);

            Log::stack([static::TELEGRAM_LOG_CHANEL])->error('od_handler_error Ошибка при обновлении мер поддержки КМНС - ' . $dataset->url,
            );
            return false;
        }
        return true;
    }

    /**
     * Проверяет появились ли новые поля у датасета
     * @param array $data
     * @return array
     */
    protected static function hasNewFields(array $data): array
    {
        $diff = array_values(
            array_diff(
                array_keys(
                    Arr::dot(static::getColsArray($data))),
                static::FIELDS,
            ),
        );
        return [
            !empty($diff),
            $diff,
        ];
    }

    /**
     * Получить первый объект из массива объектов в ответе ОД
     * @param array $data
     * @return array
     */
    protected static function getColsArray(array $data): array
    {
        return $data['rows'][0]['cols'] ?? [];
    }

    /**
     * Возвращает владиная ли структура у датасета
     * @param array $data
     * @return array
     */
    protected static function hasValidStructure(array $data): array
    {
        $rules = static::getValidateRules();

        $validator = Validator::make($data, $rules);

        return [
            $validator->passes(),
            $validator->errors(),
        ];
    }

    /**
     * Получить правила валидации объектов ответа ОД
     * @return array
     */
    protected static function getValidateRules(): array
    {
        $rules = [
            'rows' => 'required|array',
            'rows.*.cols' => 'required|array',
        ];

        foreach (static::FIELDS as $field) {
            $rules['rows.*.cols.' . $field] = 'present|string|nullable';
        }

        return $rules;
    }

    /**
     * Метод, где непосредственно идет обработка данных(вставка и т.д.)
     * @param array $data
     * @param KmnsSupportWidgetOdDataset $dataset
     * @return mixed
     */
    abstract protected static function processData(array $data, KmnsSupportWidgetOdDataset $dataset);

    /**
     * Возвращает значение идентификатора из справочника без запроса, если не найдено дополняет справочник
     * @param Collection $reference
     * @param string|null $referenceValue
     * @param Builder $query
     * @return int|null
     */
    protected static function getReferenceId(Collection $reference, ?string $referenceValue, Builder $query): ?int
    {
        if (!isset($referenceValue)) {
            return null;
        }
        $referenceValue = trim($referenceValue);
        if (isset($reference[mb_strtolower($referenceValue)])) {
            return $reference[mb_strtolower($referenceValue)]->id;
        }

        if (strlen($referenceValue) < 3) {
            return null;
        }

        $reference[mb_strtolower($referenceValue)] = $query->create(['name' => Str::ucfirst($referenceValue)]);

        return $reference[mb_strtolower($referenceValue)]->getKey();
    }

    /**
     * Убирает всякую каку из строк датасета
     * @param string $string
     * @param $minLength
     * @return string|null
     */
    protected static function prepareString(string $string, $minLength = 4): ?string
    {
        $string = trim($string);
        $string = str_replace('\\"', '"', $string);
        $string = str_replace("\n", ', ', $string);
        $string = preg_replace('/\s+/', ' ', $string);
        return mb_strlen($string) >= $minLength ? $string : null;
    }
}
