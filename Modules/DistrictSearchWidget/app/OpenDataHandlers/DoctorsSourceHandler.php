<?php

namespace Modules\DistrictSearchWidget\OpenDataHandlers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetCity;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetDistrict;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetDoctor;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetDoctorTimetableRecord;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetHospital;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetOdDataset;

class DoctorsSourceHandler extends AbstractSourceHandler
{
    protected const array FIELDS = [
        'UCHREZHDENIE_',
        '',
        '_UCHASTKA',
        'TIP_UCHASTKA_PEDIATRICHESKIY_TERAPEVTICH',
        'FAMILIYA',
        'IMYA',
        'OTCHESTVO',
        'NAIMENOVANIE_NASELENNOGO_PUNKTA',
        'ULITSA',
        'DOM_DOMA_STROENIYA',
        'KONTAKTNYY_TELEFON_FORMAT_7_KHKHKHKH_KHK',
        "NECHETNAYA_NEDELYA_PONEDELNIK",
        "NECHETNAYA_NEDELYA_PONEDELNIK_PERERYV",
        "NECHETNAYA_NEDELYA_VTORNIK",
        "NECHETNAYA_NEDELYA_VTORNIK_PERERYV",
        "NECHETNAYA_NEDELYA_SREDA",
        "NECHETNAYA_NEDELYA_SREDA_PERERYV",
        "NECHETNAYA_NEDELYA_CHETVERG",
        "NECHETNAYA_NEDELYA_CHETVERG_PERERYV",
        "NECHETNAYA_NEDELYA_PYATNITSA",
        "NECHETNAYA_NEDELYA_PYATNITSA_PERERYV",
        "NECHETNAYA_NEDELYA_SUBBOTA",
        "NECHETNAYA_NEDELYA_SUBBOTA_PERERYV",
        "NECHETNAYA_NEDELYA_VOSKRESENE",
        "NECHETNAYA_NEDELYA_VOSKRESENE_PERERYV",
        "CHETNAYA_NEDELYA_PONEDELNIK",
        "CHETNAYA_NEDELYA_PONEDELNIK_PERERYV",
        "CHETNAYA_NEDELYA_VTORNIK",
        "CHETNAYA_NEDELYA_VTORNIK_PERERYV",
        "CHETNAYA_NEDELYA_SREDA",
        "CHETNAYA_NEDELYA_SREDA_PERERYV",
        "CHETNAYA_NEDELYA_CHETVERG",
        "CHETNAYA_NEDELYA_CHETVERG_PERERYV",
        "CHETNAYA_NEDELYA_PYATNITSA",
        "CHETNAYA_NEDELYA_PYATNITSA_PERERYV",
        "CHETNAYA_NEDELYA_SUBBOTA",
        "CHETNAYA_NEDELYA_SUBBOTA_PERERYV",
        "CHETNAYA_NEDELYA_VOSKRESENE",
        "CHETNAYA_NEDELYA_VOSKRESENE_PERERYV",

    ];
    private static array $unknownHospitals = [];

    protected static function processData(array $data, DistrictSearchWidgetOdDataset $dataset): void
    {
        DistrictSearchWidgetDoctor::query()->delete();
        $hospitals = DistrictSearchWidgetHospital::query()->get()->keyBy('name');

        $rows = $data['rows'];

        foreach ($rows as $row) {

            $address =
                $row['cols']['NAIMENOVANIE_NASELENNOGO_PUNKTA'] . ', ' .
                $row['cols']['ULITSA'] . ', ' .
                $row['cols']['DOM_DOMA_STROENIYA'];


            $hospitalId = self::getHospitalId($row['cols']['UCHREZHDENIE_'], $hospitals, $row['cols']['NAIMENOVANIE_NASELENNOGO_PUNKTA']);

            if (!isset($hospitalId)) {
                continue;
            }

            $districtId = self::getDistrictId([
                'number' => $row['cols']['_UCHASTKA'],
                'type' => mb_strtolower(trim($row['cols']['TIP_UCHASTKA_PEDIATRICHESKIY_TERAPEVTICH'])),
                'hospital_id' => $hospitalId,
                'address' => $address,
            ]);
            $doctorId = self::getDoctorId([
                'last_name' => $row['cols']['FAMILIYA'],
                'first_name' => $row['cols']['IMYA'],
                'middle_name' => $row['cols']['OTCHESTVO'],
                'phone' => $row['cols']['KONTAKTNYY_TELEFON_FORMAT_7_KHKHKHKH_KHK'],
                'district_id' => $districtId,
            ]);

            self::updateOrCreateDoctorTimetable($doctorId, $row);

            self::$rowNumber++;
        }
        if (!empty(self::$unknownHospitals)) {
            Log::channel(self::TELEGRAM_LOG_CHANEL)->warning("В наборе <a href=\"https://data.admhmao.ru/opendata/8601002141-data_on_district_physicians_of_the_health_facilities_in_the_Dzhmao\">«Данные об участковых врачах объектов здравоохранения в Ханты-Мансийском автономном округе – Югре»</a> были обнаружены медицинские учреждения, отсутствующие в наборе  <a href=\"https://data.admhmao.ru/opendata/8601002141-the_data_of_health_care_institutions_in_the_khanty_mansi_autonomous_di_dzhmao\">«Данные учреждений здравоохранения в Ханты-Мансийском автономном округе – Югре»</a> : \n" . implode("\n", self::$unknownHospitals));
        }
    }


    private static function getHospitalId(string $name, Collection &$hospitals, string $cityName): ?int
    {
        if (!isset($hospitals[$name])) {
            $cityId=DistrictSearchWidgetCity::query()->firstOrCreate(['name' => $cityName])->id;
            $hospitals[$name]=DistrictSearchWidgetHospital::query()->create([
                'name' => $name,
                'city_id' => $cityId,
                'created_from_doctors_dataset' => true,
            ]);
        }

        if ($hospitals[$name]->created_from_doctors_dataset) {
            self::$unknownHospitals[$name] = $name;
        }

        return $hospitals[$name]->id;
    }

    private static function getDistrictId($districtAttributes): int
    {

        return DistrictSearchWidgetDistrict::query()
            ->updateOrCreate([
                'number' => $districtAttributes['number'],
                'type' => $districtAttributes['type'],
                'hospital_id' => $districtAttributes['hospital_id'],
            ],
                $districtAttributes)
            ->id;
    }

    private static function getDoctorId(array $doctorAttributes): int
    {
        $doctorAttributes['phone']=mb_ereg_replace('_', '-', $doctorAttributes['phone']);
        $doctorAttributes['phone']=mb_ereg_replace('-+', '-', $doctorAttributes['phone']);
        return DistrictSearchWidgetDoctor::query()
            ->firstOrCreate([
                'last_name' => $doctorAttributes['last_name'],
                'first_name' => $doctorAttributes['first_name'],
                'middle_name' => $doctorAttributes['middle_name'],
                'district_id' => $doctorAttributes['district_id'],
            ],
                ['phone' => $doctorAttributes['phone']])->id;
    }

    private static function updateOrCreateDoctorTimetable(int $doctorId, array $row)
    {

        $timetable = [
            ['day_number' => 1, 'odd_week' => true, 'time' => $row['cols']['NECHETNAYA_NEDELYA_PONEDELNIK'] ?? null, 'break_time' => $row['cols']['NECHETNAYA_NEDELYA_PONEDELNIK_PERERYV'] ?? null],
            ['day_number' => 2, 'odd_week' => true, 'time' => $row['cols']['NECHETNAYA_NEDELYA_VTORNIK'] ?? null, 'break_time' => $row['cols']['NECHETNAYA_NEDELYA_VTORNIK_PERERYV'] ?? null],
            ['day_number' => 3, 'odd_week' => true, 'time' => $row['cols']['NECHETNAYA_NEDELYA_SREDA'] ?? null, 'break_time' => $row['cols']['NECHETNAYA_NEDELYA_SREDA_PERERYV'] ?? null],
            ['day_number' => 4, 'odd_week' => true, 'time' => $row['cols']['NECHETNAYA_NEDELYA_CHETVERG'] ?? null, 'break_time' => $row['cols']['NECHETNAYA_NEDELYA_CHETVERG_PERERYV'] ?? null],
            ['day_number' => 5, 'odd_week' => true, 'time' => $row['cols']['NECHETNAYA_NEDELYA_PYATNITSA'] ?? null, 'break_time' => $row['cols']['NECHETNAYA_NEDELYA_PYATNITSA_PERERYV'] ?? null],
            ['day_number' => 6, 'odd_week' => true, 'time' => $row['cols']['NECHETNAYA_NEDELYA_SUBBOTA'] ?? null, 'break_time' => $row['cols']['NECHETNAYA_NEDELYA_SUBBOTA_PERERYV'] ?? null],
            ['day_number' => 7, 'odd_week' => true, 'time' => $row['cols']['NECHETNAYA_NEDELYA_VOSKRESENE'] ?? null, 'break_time' => $row['cols']['NECHETNAYA_NEDELYA_VOSKRESENE_PERERYV'] ?? null],

            ['day_number' => 1, 'odd_week' => false, 'time' => $row['cols']['CHETNAYA_NEDELYA_PONEDELNIK'] ?? null, 'break_time' => $row['cols']['CHETNAYA_NEDELYA_PONEDELNIK_PERERYV'] ?? null],
            ['day_number' => 2, 'odd_week' => false, 'time' => $row['cols']['CHETNAYA_NEDELYA_VTORNIK'] ?? null, 'break_time' => $row['cols']['CHETNAYA_NEDELYA_VTORNIK_PERERYV'] ?? null],
            ['day_number' => 3, 'odd_week' => false, 'time' => $row['cols']['CHETNAYA_NEDELYA_SREDA'] ?? null, 'break_time' => $row['cols']['CHETNAYA_NEDELYA_SREDA_PERERYV'] ?? null],
            ['day_number' => 4, 'odd_week' => false, 'time' => $row['cols']['CHETNAYA_NEDELYA_CHETVERG'] ?? null, 'break_time' => $row['cols']['CHETNAYA_NEDELYA_CHETVERG_PERERYV'] ?? null],
            ['day_number' => 5, 'odd_week' => false, 'time' => $row['cols']['CHETNAYA_NEDELYA_PYATNITSA'] ?? null, 'break_time' => $row['cols']['CHETNAYA_NEDELYA_PYATNITSA_PERERYV'] ?? null],
            ['day_number' => 6, 'odd_week' => false, 'time' => $row['cols']['CHETNAYA_NEDELYA_SUBBOTA'] ?? null, 'break_time' => $row['cols']['CHETNAYA_NEDELYA_SUBBOTA_PERERYV'] ?? null],
            ['day_number' => 7, 'odd_week' => false, 'time' => $row['cols']['CHETNAYA_NEDELYA_VOSKRESENE'] ?? null, 'break_time' => $row['cols']['CHETNAYA_NEDELYA_VOSKRESENE_PERERYV'] ?? null],
        ];

        foreach ($timetable as $time) {

            $time['time'] = self::prepareTimeForTimetable($time['time']);
            $time['break_time'] = self::prepareTimeForTimetable($time['break_time']);

            DistrictSearchWidgetDoctorTimetableRecord::query()->updateOrCreate([
                'doctor_id' => $doctorId,
                'day_number' => $time['day_number'],
                'odd_week' => $time['odd_week'],
            ],
                $time);
        }
    }

    private static function prepareTimeForTimetable($time): ?string
    {
        $time = mb_ereg_replace(' ?- ?', '-', $time);
        $time = mb_ereg_replace('\d\d?\.\d\d?\.\d\d\d\d', '', $time);
        $time = mb_ereg_replace('[,\.]', ':', $time);
        $time = mb_ereg_replace('_', '-', $time);
        $time = mb_ereg_replace('-+', '-', $time);
        if ($time == '-') {
            $time = null;
        }
        return $time;
    }
}
