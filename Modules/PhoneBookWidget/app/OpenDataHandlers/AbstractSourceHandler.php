<?php

namespace Modules\PhoneBookWidget\OpenDataHandlers;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Modules\PhoneBookWidget\Models\OdDataset;

abstract class AbstractSourceHandler implements OpenDataHandler
{
    protected const array FIELDS = [];
    protected const string DATASET_LOG_CHANEL = 'phonebook_open_data';
    protected const string TELEGRAM_LOG_CHANEL = 'telegram_phonebook';
    protected static int $rowNumber = 0;

    /**
     * @throws Exception
     */
    public static function handle(array $data, OdDataset $dataset): void
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
            Log::stack([static::DATASET_LOG_CHANEL, static::TELEGRAM_LOG_CHANEL])
                ->error(
                    "В наборе открытых данных \"$dataset->description\" были обнаружены ошибки валидации",
                    ['errors' => $validationErrors, 'dataSet' => $dataset],
                );
            throw new Exception('В наборе открытых данных "' . $dataset->description . '" были обнаружены ошибки валидации');
        }
        try {
            static::processData($data, $dataset);
        } catch (\Throwable $e) {
            Log::stack([static::DATASET_LOG_CHANEL, static::TELEGRAM_LOG_CHANEL])->error('od_handler_error Ошибка при обновлении телефонного справочника',
                [
                    'handler' => static::class,
                    'row' => static::$rowNumber,
                    'dataset_url' => $dataset->url,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
        }
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

    abstract protected static function processData(array $data, OdDataset $dataset);
}
