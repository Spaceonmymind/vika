<?php

namespace Modules\DistrictSearchWidget\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetCity;
use Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetDistrict;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetStreet;

class DistrictSearchService
{
    /**
     * Возвращает список городов
     * @return Collection
     */
    public function getCities(): Collection
    {
        return DistrictSearchWidgetCity::query()
            ->select(['id', 'name'])
            ->whereHas('district_search_widget_streets', function (Builder $q) {
                $q->whereHas('district_search_widget_areas');
            })
            ->orderBy('name')
            ->get();
    }

    /**
     * Возвращает список улиц, для которых есть  медицинские участки
     * @param int $cityId
     * @return Collection|DistrictSearchWidgetStreet[]
     */
    public function getStreets(int $cityId): Collection
    {
        return DistrictSearchWidgetStreet::query()
            ->orderBy('name')
            ->select(['id', 'name'])
            ->where('city_id', $cityId)
            ->whereHas('district_search_widget_areas')
            ->get();
    }

    /**
     * Возвращает список участков, доступных по конкретному адресу
     * @param int $streetId
     * @param string $houseNumber
     * @return Collection|DistrictSearchWidgetDistrict[]
     */
    public function getDistricts(int $streetId, string $houseNumber): Collection
    {
        $areaTypeId=$this->getAreaTypeId($houseNumber);
        $houseNumber = $this->prepareHouseNumber($houseNumber);

        return DistrictSearchWidgetDistrict::query()
            ->with([
                'district_search_widget_hospital:id,name,address,site,email,phone',
                'district_search_widget_doctors.even_week_timetable_records:id,day_number,break_time,time,doctor_id',
                'district_search_widget_doctors.odd_week_timetable_records:id,day_number,break_time,time,doctor_id',
            ])
            ->whereHas('district_search_widget_areas', function (Builder $q) use ($streetId, $houseNumber) {
                $q
                    ->where('street_id', $streetId)
                    ->where('district_search_widget_area_type_id',1)
                    ->where('max_house_number', '>=', $houseNumber)
                    ->where('min_house_number', '<=', $houseNumber);
            })
            ->orWhereHas('district_search_widget_areas', function (Builder $q) use ($streetId, $houseNumber,$areaTypeId) {
                $q
                    ->where('street_id', $streetId)
                    ->where('district_search_widget_area_type_id',$areaTypeId)
                    ->where('max_house_number', '>=', $houseNumber)
                    ->where('min_house_number', '<=', $houseNumber);
            })
            ->get();
    }

    /**
     * Подготавливает номер дома для поиска в базе
     * @param $houseNumber
     * @return string
     */
    private function prepareHouseNumber($houseNumber): string
    {
        $houseNumber = str_replace(' ', '', $houseNumber);

        if (preg_match('/^\d+/', $houseNumber, $matches)) {
            $number = Str::padLeft($matches[0], 4, '0');
            return preg_replace('/\d+/', $number, $houseNumber, 1);
        }
        return $houseNumber;
    }


    /**
     * Возвращает тип области участка, 2- четные дома диапазона , 3- нечётные
     * @param $houseNumber
     * @return int
     */
    private function getAreaTypeId($houseNumber):int
    {
        if (preg_match('/^\d+/', $houseNumber, $matches)) {
            return 2 + ((int)$matches[0] % 2);
        }
        return 1;
    }
}
