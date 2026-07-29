<?php

namespace Modules\ITSupportWidget\OpenDataHandlers;

use Exception;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\ITSupportWidget\Models\ItSupportWidgetOdDataset;
use Modules\ITSupportWidget\OpenDataHandlers\OpenDataHandler;

abstract class AbstractSourceHandler implements OpenDataHandler
{
    protected const array FIELDS = [];
    protected const string DATASET_LOG_CHANEL = 'it_support_open_data';
    protected const string TELEGRAM_LOG_CHANEL = 'telegram_it_support';
    protected static int $rowNumber = 0;

    /**
     * @throws Exception
     */
    public static function handle(array $data, ItSupportWidgetOdDataset $dataset): bool
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

            Log::stack([static::DATASET_LOG_CHANEL, static::TELEGRAM_LOG_CHANEL])->error('od_handler_error Ошибка при обновлении мер поддержки it',
                [
                    'handler' => static::class,
                    'row' => static::$rowNumber,
                    'dataset_url' => $dataset->url,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);

            Log::stack([ static::TELEGRAM_LOG_CHANEL])->error('od_handler_error Ошибка при обновлении мер поддержки it - '.$dataset->url,
            );
            return false;
        }
        return true;
    }

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

    abstract protected static function processData(array $data, ItSupportWidgetOdDataset $dataset);


    protected static function prepareString(string $string, $minLength = 4): ?string
    {
        $string = trim($string);
        $string = str_replace('\\"', '"', $string);

        return mb_strlen($string) >= $minLength ? $string : null;
    }
}
