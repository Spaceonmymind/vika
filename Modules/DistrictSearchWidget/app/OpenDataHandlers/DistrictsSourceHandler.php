<?php

namespace Modules\DistrictSearchWidget\OpenDataHandlers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetArea;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetCity;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetDistrict;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetHospital;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetOdDataset;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetStreet;

class DistrictsSourceHandler extends AbstractSourceHandler
{
    protected const array FIELDS = [
        'UCHREZHDENIE',
        '',
        'ULITSA',
        'DOM_DIAPAZON_DOMOV_DIAPAZON_UKAZYVAETSYA',
        'CHETNOST_VSE_DOMA_DIAPAZONA_CHETNYE_DOMA',
        '_UCHASTKA',
        'TIP_UCHASTKA',
    ];
    private const STREET_TYPES = ['улица', ', ул.', 'переулок', 'проспект',];
    private static array $unknownHospitals = [];

    /**
     * @param array $data
     * @param DistrictSearchWidgetOdDataset $dataset
     * @return void
     */
    protected static function processData(array $data, DistrictSearchWidgetOdDataset $dataset): void
    {
        DistrictSearchWidgetArea::query()->delete();
        DistrictSearchWidgetStreet::query()->delete();
        $hospitals = DistrictSearchWidgetHospital::query()->get()->keyBy('name');

        $rows = $data['rows'];

        foreach ($rows as $row) {

            $hospital = self::getHospital($row['cols']['UCHREZHDENIE'], $hospitals);

            if (!isset($hospital)) {
                Log::channel(self::DATASET_LOG_CHANEL)->debug('Больница не найдена', ['row' => $row['cols']]);
                self::$rowNumber++;

                continue;
            }
            $district = self::getDistrict($hospital->id, $row['cols']['TIP_UCHASTKA'], $row['cols']['_UCHASTKA']);

            [$cityName, $streetName] = self::getCityFromStreet($row['cols']['ULITSA']);

            if (strlen($streetName) > 500 || !isset($streetName)) {

                Log::channel(self::DATASET_LOG_CHANEL)->debug('Не удалось обработать название улицы', ['row' => $row['cols']]);

                self::$rowNumber++;

                continue;
            }

            if (isset($cityName) && strlen(trim($cityName)) >= 3) {
                $cityId = DistrictSearchWidgetCity::query()->firstOrCreate(['name' => $cityName], [])->id;
            } else {
                $cityId = $hospital->city_id;
            }

            $street = DistrictSearchWidgetStreet::query()->firstOrCreate([
                'name' => $streetName,
                'city_id' => $cityId,
            ],
                [],
            );
            self::saveHouseNumbers($street, $row['cols']['DOM_DIAPAZON_DOMOV_DIAPAZON_UKAZYVAETSYA'], $row['cols']['CHETNOST_VSE_DOMA_DIAPAZONA_CHETNYE_DOMA'], $district->id);

            self::$rowNumber++;
        }

        if (!empty(self::$unknownHospitals)) {
            Log::channel(self::TELEGRAM_LOG_CHANEL)->warning("В наборе открытых данных <a href=\"https://data.admhmao.ru/opendata/8601002141-AddressesAndAreas_Dzhmao\">«Данные об участках объектов здравоохранения в Ханты-Мансийском автономном округе – Югре»</a> были обнаружены больницы, не встреченные в остальных наборах: \n" . implode("\n", self::$unknownHospitals));
        }
    }

    /**
     * Возвращает медицинскую организацию
     * @param string $name
     * @param Collection $hospitals
     * @return DistrictSearchWidgetHospital|null
     */
    private static function getHospital(string $name, Collection $hospitals): ?DistrictSearchWidgetHospital
    {
        if (!isset($hospitals[$name])) {
            self::$unknownHospitals[$name] = $name;
            return null;
        }
        return $hospitals[$name];
    }

    /**
     * Возвращает, либо создает медицинский участок
     *
     * @param $hospitalId
     * @param $districtType
     * @param $number
     * @return DistrictSearchWidgetDistrict
     */
    private static function getDistrict($hospitalId, $districtType, $number): DistrictSearchWidgetDistrict
    {
        return DistrictSearchWidgetDistrict::query()->firstOrCreate([
            'number' => $number,
            'type' => trim(mb_strtolower($districtType)),
            'hospital_id' => $hospitalId,
        ], []);
    }

    /**
     * Пытается вычленить название населённого пункта из названия улицы
     * @param $streetName
     * @return array
     */
    private static function getCityFromStreet($streetName): array
    {
        $streetName=str_replace('\\','',$streetName);

        $streetName=trim($streetName);
        if (str_contains(mb_strtolower($streetName), 'микрорайон')) {
            return ['', $streetName];
        }
        if (str_contains(mb_strtolower($streetName), 'мкр-он')) {
            return ['', $streetName];
        }

        if (str_contains(mb_strtolower($streetName), 'промзона')) {
            return ['', $streetName];
        }

        foreach (self::STREET_TYPES as $streetType) {

            if (str_starts_with(trim($streetName), $streetType)) {
                return ['', $streetName];
            }
            if (str_ends_with(trim($streetName), $streetType)) {
                if($streetType==', ул.'){
                    return ['', 'ул. ' . str_replace($streetType, '', $streetName)];
                }
                return ['', $streetType . ' ' . str_replace($streetType, '', $streetName)];
            }

            if (($position = strpos($streetName, $streetType)) !== false) {

                $cityName=trim(substr($streetName, 0, $position));
                $street=str_replace(', ул.','ул.',substr($streetName, $position));

                return [$cityName, $street];
            }

        }
        return ['', $streetName];
    }

    /**
     * Сохраняет номера домов участков для конкретной улицы
     * @param DistrictSearchWidgetStreet $street
     * @param string $houseNumbers
     * @param string $rangeType
     * @param int $districtId
     * @return void
     */
    private static function saveHouseNumbers(DistrictSearchWidgetStreet $street, string $houseNumbers, string $rangeType, int $districtId): void
    {
        $districtAreaTypeId = match (mb_strtolower($rangeType)) {
            'в' => 1,
            'ч' => 2,
            'н' => 3,
            default => 1
        };
        $houseNumbers = str_replace(' ', '', $houseNumbers);

        $houseNumbers = explode(',', $houseNumbers);
        foreach ($houseNumbers as $houseNumber) {
            $houseNumber = trim($houseNumber);

            if (str_contains($houseNumber, '--') || str_contains($houseNumber, '-')) {
                if ($houseNumber == '-') {
                    Log::channel(self::DATASET_LOG_CHANEL)->debug('Не удалось обработать диапазон домов', [
                        'house_range' => $houseNumbers,
                        'row_number' => self::$rowNumber,
                    ]);
                    return;
                }


                $separator = str_contains($houseNumber, '--') ? '--' : '-';

                [$minHouseNumber, $maxHouseNumber] = explode($separator, $houseNumber);

                $minHouseNumber = self::padHouseNumber($minHouseNumber);
                $maxHouseNumber = self::padHouseNumber($maxHouseNumber);
                if (strlen($minHouseNumber) > 10 || strlen($maxHouseNumber) > 10) {
                    Log::channel(self::DATASET_LOG_CHANEL)->debug('Не удалось обработать диапазон домов', [
                        'house_range' => $houseNumbers,
                        'row_number' => self::$rowNumber,
                    ]);
                    return;
                }


                DistrictSearchWidgetArea::query()->create([
                    'district_search_widget_area_type_id' => $districtAreaTypeId,
                    'district_id' => $districtId,
                    'street_id' => $street->id,
                    'city_id' => $street->city_id,
                    'min_house_number' => $minHouseNumber,
                    'max_house_number' => $maxHouseNumber,
                ]);

            } else {

                $houseNumber = trim($houseNumber);

                if ($houseNumber !== '') {

                    if (str_contains(mb_strtolower($houseNumber), 'все')) {
                        DistrictSearchWidgetArea::query()->create([
                            'district_search_widget_area_type_id' => $districtAreaTypeId,
                            'district_id' => $districtId,
                            'street_id' => $street->id,
                            'city_id' => $street->city_id,
                            'min_house_number' => '0001',
                            'max_house_number' => '9999',
                        ]);
                    }

                    $houseNumber = self::padHouseNumber($houseNumber);

                    if (strlen($houseNumber) > 10) {
                        Log::channel(self::DATASET_LOG_CHANEL)->debug('Диапазон домов пошел не так', ['row' => $houseNumbers]);
                        return;
                    }

                    DistrictSearchWidgetArea::query()->create([
                        'district_search_widget_area_type_id' => 1,
                        'district_id' => $districtId,
                        'street_id' => $street->id,
                        'city_id' => $street->city_id,
                        'min_house_number' => $houseNumber,
                        'max_house_number' => $houseNumber,
                    ]);
                }

            }

        }

    }

    /**
     * Добивка номера дома ведущими нулями, чтобы было проще сравнивать при поиске
     * @param $houseNumber
     * @return string
     */
    private static function padHouseNumber($houseNumber): string
    {
        if (preg_match('/\d+/', $houseNumber, $matches)) {
            $number = Str::padLeft($matches[0], 4, '0');
            return preg_replace('/\d+/', $number, $houseNumber, 1);
        }
        return $houseNumber;
    }
}
