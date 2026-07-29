<?php

namespace Modules\SocialSupportWidget\OpenDataHandlers;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Modules\SocialSupportWidget\Models\SocialSupportWidgetOdDataset;
use Modules\SocialSupportWidget\Models\SocialSupportWidgetPreferentialCategory;
use Modules\SocialSupportWidget\Models\SocialSupportWidgetSituation;
use Modules\SocialSupportWidget\Models\SocialSupportWidgetSocialSupportMeasure;

class SocialSupportSourceHandler implements OpenDataHandler
{
    protected const array FIELDS = [
        '0',
        '1',
        '2',
        '36',
        '16306',
        'KOD',
        'DATA_VNESENIYA',
        'DATA_IZMENENIYA',
        'NAIMENOVANIE',
        'USLOVIYA_POLUCHENIYA',
        'RAZMER_I_SROKI_VYPLATY',
        'PRAVOVYE_OSNOVANIYA_VYPLATY',
        'BAZOVAYA_IKONKA',
        'ALGORITM_RASCHETA',
        'BAZOVAYA_SUMMA_MIN',
        'BAZOVAYA_SUMMA_MAKS',
        'NABOR_LGOTNYKH_KATEGORIY_I_PODKATEGORIY',
        'OGRANICHENIE_PO_SREDNEDUSHEVOMU_DOKHODU',
        'OGRANICHENIE_PO_VOZRASTU_1_MIN_MES_',
        'OGRANICHENIE_PO_VOZRASTU_1_MAKS_MES_',
        'OGRANICHENIE_PO_VOZRASTU_1_KOL_VO_CHL_SE',
        'OGRANICHENIE_PO_VOZRASTU_2_MIN_MES_',
        'OGRANICHENIE_PO_VOZRASTU_2_MAKS_MES_',
        'OGRANICHENIE_PO_VOZRASTU_2_KOL_VO_CHL_SE',
        'NABOR_PRIZNAKOV_1',
        'NABOR_PRIZNAKOV_2',
        'NABOR_PRIZNAKOV_3',
        'NABOR_PRIZNAKOV_4',
        'NABOR_PRIZNAKOV_5',
        'NABOR_PRIZNAKOV_6',
        'NABOR_PRIZNAKOV_7',
        'NABOR_PRIZNAKOV_8',
        'NABOR_PRIZNAKOV_9',
        'NABOR_PRIZNAKOV_10',
        'ADRES_NA_EPGU',
        'SROK_STAZH_PROZHIVANIYA_V_OKRUGE_LET',
        '01_01_2018',
        '28_04_2021',
        'EZHEMESYACHNAYA_VYPLATA_V_SVYAZI_S_ROZHD',
        'RAZMER_SREDNEDUSHEVOGO_DOKHODA_SEMI_NE_P',
        'VYPLACHIVAETSYA_EZHEMESYACHNO_V_RAZMERE_',
        'FEDERALNYY_ZAKON_OT_28_12_2017_418_FZ_O_',
        '6_3_2_1',
        'FIKSIROVANNYY',
        'BEREMENNOST_I_ROZHDENIE_REBENKA',
        'ROZHDENIE_PERVOGO_REBENKA',
        'HTTPS_WWW_GOSUSLUGI_RU_330332_1_FORM',
    ];
    protected const string DATASET_LOG_CHANEL = 'social_help_measures_open_data';
    protected const string TELEGRAM_LOG_CHANEL = 'telegram_social_help_measures';
    private const MINIMUM_LIVING_COST = 22274;
    protected static int $rowNumber = 0;

    /**
     * @throws Exception
     */
    public static function handle(array $data, SocialSupportWidgetOdDataset $dataset): void
    {

        [$hasNewFields, $newFields] = static::hasNewFields($data);

        if ($hasNewFields) {
            Log::channel(static::DATASET_LOG_CHANEL)
                ->info(
                    "В наборе открытых данных \"$dataset->description\"  были обнаружены новые поля",
                    ['newFields' => $newFields, 'dataSet' => $dataset],
                );
            Log::channel(static::TELEGRAM_LOG_CHANEL)
                ->info(
                    "В наборе открытых данных \"$dataset->description\"  были обнаружены новые поля",

                );
        }

        [$hasValidStructure, $validationErrors] = static::hasValidStructure($data);

        if (!$hasValidStructure) {
            Log::channel(static::DATASET_LOG_CHANEL)
                ->error(
                    "В наборе открытых данных \"$dataset->description\" были обнаружены ошибки валидации",
                    ['errors' => $validationErrors, 'dataSet' => $dataset],
                );
            Log::channel(static::TELEGRAM_LOG_CHANEL)
                ->error(
                    "В наборе открытых данных \"$dataset->description\" были обнаружены ошибки валидации",
                );
            throw new Exception('В наборе открытых данных "' . $dataset->description . '" были обнаружены ошибки валидации');
        }

        DB::transaction(function () {
            SocialSupportWidgetSocialSupportMeasure::query()->delete();
        });

        try {
            static::processData($data, $dataset);
        } catch (\Throwable $e) {
            Log::channel(static::DATASET_LOG_CHANEL)->error('od_handler_error Ошибка при обновлении мер социальной поддержки',
                [
                    'handler' => static::class,
                    'row' => static::$rowNumber,
                    'dataset_url' => $dataset->url,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
            Log::channel(static::TELEGRAM_LOG_CHANEL)->error('od_handler_error Ошибка при обновлении мер социальной поддержки',
            );
        }
    }

    /**
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
     * Обработка данных, прилетевших из ОД
     * @param array $data
     * @param SocialSupportWidgetOdDataset $dataset
     * @return void
     */
    protected static function processData(array $data, SocialSupportWidgetOdDataset $dataset)
    {
        $situations = SocialSupportWidgetSituation::query()->get()->keyBy('name');
        $preferentialCategoriesCatalog = SocialSupportWidgetPreferentialCategory::query()->get()->keyBy('name');
        foreach ($data['rows'] as $row) {
            $cols = $row['cols'];

            if (empty($cols['KOD'])) {
                continue;
            }
            $situationId = self::getSituationId($situations, $cols);

            $preferentialCategories = self::getPreferentialCategories($preferentialCategoriesCatalog, $cols);

            $measure = SocialSupportWidgetSocialSupportMeasure::query()->create([
                'name' => str_replace('\\', '', $cols['NAIMENOVANIE']),
                'conditions' => !empty(trim($cols['USLOVIYA_POLUCHENIYA'])) ? trim($cols['USLOVIYA_POLUCHENIYA']) : 'Отсутствуют',
                'amount_and_deadlines' => !empty(trim($cols['RAZMER_I_SROKI_VYPLATY'])) ? trim($cols['RAZMER_I_SROKI_VYPLATY']) : null,
                'law' => str_replace('\\', '', $cols['PRAVOVYE_OSNOVANIYA_VYPLATY']),
                'min_amount' => !empty($cols['BAZOVAYA_SUMMA_MIN']) ? $cols['BAZOVAYA_SUMMA_MIN'] : null,
                'max_amount' => !empty($cols['BAZOVAYA_SUMMA_MAKS']) ? $cols['BAZOVAYA_SUMMA_MAKS'] : null,
                'situation_id' => $situationId,
                'max_family_income' => self::getIncome($cols['OGRANICHENIE_PO_SREDNEDUSHEVOMU_DOKHODU']),
                'min_child_age' => !empty($cols['OGRANICHENIE_PO_VOZRASTU_1_MIN_MES_']) ? $cols['OGRANICHENIE_PO_VOZRASTU_1_MIN_MES_'] : null,
                'max_child_age' => !empty($cols['OGRANICHENIE_PO_VOZRASTU_1_MAKS_MES_']) ? $cols['OGRANICHENIE_PO_VOZRASTU_1_MAKS_MES_'] : null,
                'live_in_ugra_years' => !empty($cols['SROK_STAZH_PROZHIVANIYA_V_OKRUGE_LET']) ? $cols['SROK_STAZH_PROZHIVANIYA_V_OKRUGE_LET'] : null,
                'create_date' => !empty($cols['DATA_VNESENIYA']) ? Carbon::parse($cols['DATA_VNESENIYA']) : Carbon::now(),
                'update_date' => !empty($cols['DATA_IZMENENIYA']) ? Carbon::parse($cols['DATA_IZMENENIYA']) : Carbon::now(),
                'epgu_link' => !empty($cols['ADRES_NA_EPGU']) ? $cols['ADRES_NA_EPGU'] : null,
            ]);

            $measure->preferential_categories()->sync($preferentialCategories);
        }
    }

    /**
     * Возвращает жизненную ситуацию
     * @param Collection $situations
     * @param $cols
     * @return null
     */
    private static function getSituationId(Collection $situations, $cols)
    {
        for ($i = 1; $i <= 10; $i++) {
            if (!empty($cols['NABOR_PRIZNAKOV_' . $i]) && isset($situations[$cols['NABOR_PRIZNAKOV_' . $i]])) {
                return $situations[$cols['NABOR_PRIZNAKOV_' . $i]]->id;
            }
        }
        return null;
    }

    /**
     * Возвращает массив идентификаторов льготных категорий
     * @param Collection $preferentialCategories
     * @param $cols
     * @return array
     */
    private static function getPreferentialCategories(Collection $preferentialCategories, $cols)
    {
        $categories = [];
        for ($i = 1; $i <= 10; $i++) {
            if (!empty($cols['NABOR_PRIZNAKOV_' . $i]) && isset($preferentialCategories[$cols['NABOR_PRIZNAKOV_' . $i]])) {
                $categories[] = $preferentialCategories[$cols['NABOR_PRIZNAKOV_' . $i]]->id;
            }
        }
        foreach (explode(',', $cols['NABOR_LGOTNYKH_KATEGORIY_I_PODKATEGORIY']) as $category) {
            if (isset($preferentialCategories[$category])) {
                $categories[] = $preferentialCategories[$category]->id;
            }
        }
        return $categories;
    }

    /**
     * Переводит строку, содержащую количество МРОТ в рубли
     * @param string $income
     * @return float|null
     */
    private static function getIncome(string $income): ?float
    {
        $income = str_replace(',', '.', $income);
        if (is_numeric($income)) {
            return floatval($income) * self::MINIMUM_LIVING_COST;
        }
        return null;
    }
}
