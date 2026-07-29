<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Modules\SportSectionsWidget\Models\City;
use Modules\SportSectionsWidget\Models\OdDataset;
use Modules\SportSectionsWidget\Models\Organisation;
use Modules\SportSectionsWidget\Models\Sport;
use Modules\SportSectionsWidget\Models\Trainer;

abstract class AbstractSourceHandler implements OpenDataHandler
{
    protected const array FIELDS = [];
    protected const string DATASET_LOG_CHANEL = 'sport_sections_open_data';
    protected const string TELEGRAM_LOG_CHANEL = 'telegram_sport_sections';
    protected static int $rowNumber = 0;
    protected static array $unknownTrainers = [];
    protected static array $unknownInns = [];

    /**
     * @throws Exception
     */
    public static function handle(array $data, OdDataset $dataset): bool
    {
        [$hasNewFields, $newFields] = static::hasNewFields($data);

        if ($hasNewFields) {
            Log::stack([static::DATASET_LOG_CHANEL, static::TELEGRAM_LOG_CHANEL])
                ->info(
                    "В наборе открытых данных <a href=\"$dataset->url\">$dataset->description</a> были обнаружены новые поля",
                    ['newFields' => $newFields, 'dataSet' => $dataset],
                );
        }

        [$hasValidStructure, $validationErrors] = static::hasValidStructure($data);

        if (!$hasValidStructure) {
            Log::stack([static::DATASET_LOG_CHANEL, static::TELEGRAM_LOG_CHANEL])
                ->error(
                    "В наборе открытых данных <a href=\"$dataset->url\">$dataset->description</a> были обнаружены ошибки валидации",
                    ['errors' => $validationErrors, 'dataSet' => $dataset],
                );
            throw new Exception('В наборе открытых данных "' . $dataset->description . '" были обнаружены ошибки валидации');
        }
        try {
            static::processData($data, $dataset);
            return true;
        } catch (\Throwable $e) {
            Log::channel(static::DATASET_LOG_CHANEL)->error('od_handler_error Ошибка при обновлении информации о спортивных секциях',
                [
                    'handler' => static::class,
                    'row' => static::$rowNumber,
                    'dataset_url' => $dataset->url,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
            Log::channel(static::TELEGRAM_LOG_CHANEL)->error('Возникла непредвиденная ошибка при обновлении информации о спортивных секциях');
            return false;
        }
    }

    public static function hasNewFields(array $data): array
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
     * @param $data
     * @return array
     */
    public static function getColsArray($data): array
    {
        return $data['rows'][0]['cols'] ?? [];
    }

    public static function hasValidStructure(array $data): array
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
     * Убрать лишние пробелы во всех атрибутах модели. Если модель Trainer, то дополнительные обработки.
     * @param Model $model
     * @param array $attributes
     * @return Model
     */
    protected static function createModelWithTrimAttributes(Model $model, array $attributes): Model
    {
        $attributes = array_map(function ($value) {
            return is_string($value) ? trim($value) : $value;
        }, $attributes);

        if ($model instanceof Trainer) {
            $attributes = self::prepareTrainerAttributes($attributes);
        }

        return $model::query()->create($attributes);
    }

    /**
     * Заменить категории и очистить ФИО
     * @param array $attributes
     * @return array
     */
    private static function prepareTrainerAttributes(array $attributes): array
    {
        $arr = [
            'отсутствует',
            'без разряда',
            'б/к'
        ];

        $category = mb_strtolower($attributes['category']);

        if (in_array($category, $arr) || mb_strlen($category) <= 3) {
            $attributes['category'] = null;
        }

        $name = trim($attributes['name']);
        $name = str_replace('\"', '"', $name);
        $attributes['name'] = $name;

        return $attributes;
    }

    protected static function getCityId(string $cityName, int $municipalityId): int
    {
        return City::query()
            ->firstOrCreate(['name' => trim($cityName), 'municipality_id' => $municipalityId])->id;
    }

    protected static function getSportId(string $name): int
    {
        $name = trim($name);
        $name = str_replace('\"', '"', $name);
        return Sport::query()
            ->firstOrCreate(['name' => trim($name)])->id;
    }

    protected static function getOrganisationId(?int $inn): int
    {
        $organisationId = Organisation::query()->where('inn', $inn)->value('id');
        if ($organisationId === null) {
            self::$unknownInns[] = $inn;
            throw new ModelNotFoundException("Не найдена организация с указанным ИНН ($inn)");
        }
        return $organisationId;
    }

    protected static function getTrainerId(?string $name): int
    {
        $name = trim($name);
        $name = str_replace('\"', '"', $name);
        $trainerId = Trainer::query()->where('name', trim($name))->value('id');
        if ($trainerId === null) {
            if (mb_strlen($name) >= 100) {
                self::$unknownTrainers[] = 'СПИСОК ФИО ДЛИНОЙ БОЛЬШЕ 100 СИМВОЛОВ';
            } else {
                self::$unknownTrainers[] = $name;
            }

            throw new ModelNotFoundException("Не найден тренер с указанным ФИО ($name)");
        }
        return $trainerId;
    }

    /**
     * Извлекает минимальный и максимальный возраст из строки возрастных ограничений.
     *
     * @param string $ageRestrictions Строка возрастных ограничений.
     * @return array Массив с минимальным и максимальным возрастом. Возвращает [null, null], если диапазон не удалось определить.
     */
    protected static function extractAgeRange(string $ageRestrictions): array
    {
        // Удаление лишних символов и разделение строки на числа
        $numbers = preg_replace('/[^0-9\- ]/', '', $ageRestrictions);
        preg_match_all('/\d+/', $numbers, $matches);
        $ages = $matches[0];

        if (empty($ages)) {
            return [null, null];
        }

        // Преобразование строковых значений в числа
        $ages = array_map('intval', $ages);

        // Определение минимального и максимального возраста
        $minAge = min($ages);
        $maxAge = count($ages) > 1 ? max($ages) : null;

        // Проверка на валидный диапазон возрастов
        if ($minAge > $maxAge) {
            return [$maxAge, $minAge];
        }

        // Убираем выбивающиеся из разумного диапазона числа
        if ($minAge < 0 || $minAge > 100) $minAge = null;
        if ($maxAge !== null && ($maxAge > 100 || $maxAge < $minAge)) $maxAge = null;

        return [$minAge, $maxAge];
    }

    abstract protected static function processData(array $data, OdDataset $dataset);
}
