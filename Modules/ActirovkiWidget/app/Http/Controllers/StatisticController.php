<?php

namespace Modules\ActirovkiWidget\Http\Controllers;

use Carbon\CarbonImmutable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\ActirovkiWidget\Models\City;
use Modules\ActirovkiWidget\Models\Row;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\StatisticController\AllToday;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\StatisticController\Index;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class StatisticController extends Controller
{
    protected const array SCHOOL_CLASS_RANGES = [4, 8, 11];
    protected const array SHIFTS = [1, 2];

    #[Index]
    public function byCity(Request $request): JsonResponse
    {
        $rows = QueryBuilder::for(Row::class)
            ->allowedFilters([
                AllowedFilter::exact('city_id'),
                AllowedFilter::callback('date_from', static function ($query, $value) {
                    $query->where('created_at', '>=', CarbonImmutable::parse($value)->startOfDay());
                }),
                AllowedFilter::callback('date_to', static function ($query, $value) {
                    $query->where('created_at', '<=', CarbonImmutable::parse($value)->endOfDay());
                }),
            ])
            ->select([
                'actirovki_widget_rows.city_id',
                'actirovki_widget_rows.school_shift',
                'actirovki_widget_weather_ranges.school_class',
                DB::raw('count(*) as total'),
            ])
            ->join(
                'actirovki_widget_weather_ranges',
                'actirovki_widget_rows.weather_range_id',
                '=',
                'actirovki_widget_weather_ranges.id'
            )
            ->groupBy('actirovki_widget_rows.city_id', 'actirovki_widget_rows.school_shift', 'actirovki_widget_weather_ranges.school_class')
            ->orderBy('actirovki_widget_rows.city_id')
            ->get();

        $cities = QueryBuilder::for(City::class)
            ->allowedFilters([AllowedFilter::exact('city_id', 'id')])
            ->orderBy('name')
            ->get()
            ->pluck('name', 'id');

        $pivot = [];
        foreach ($rows as $row) {
            /** @var Row $row */
            $pivot[$row->city_id][$row->school_shift][(int)$row->getAttribute('school_class')] = $row->getAttribute('total');
        }

        $result = [];
        foreach ($cities as $cityId => $cityName) {
            $entry = [
                'city' => $cityName,
                'shifts' => [],
            ];

            foreach (self::SHIFTS as $shift) {
                $entry['shifts'][$shift] = [];
                foreach (self::SCHOOL_CLASS_RANGES as $range) {
                    $entry['shifts'][$shift][$range] = $pivot[$cityId][$shift][$range] ?? 0;
                }
            }

            $result[] = $entry;
        }

        return response()->json(['data' => $result]);
    }

    #[AllToday]
    public function allToday(): JsonResponse
    {
        $today = CarbonImmutable::today();

        $rows = Row::query()
            ->select([
                'actirovki_widget_rows.school_shift',
                'actirovki_widget_weather_ranges.school_class',
                DB::raw('count(*) as total'),
            ])
            ->join(
                'actirovki_widget_weather_ranges',
                'actirovki_widget_rows.weather_range_id',
                '=',
                'actirovki_widget_weather_ranges.id'
            )
            ->whereBetween(
                'actirovki_widget_rows.created_at',
                [$today->startOfDay(), $today->endOfDay()]
            )
            ->groupBy(
                'actirovki_widget_rows.school_shift',
                'actirovki_widget_weather_ranges.school_class'
            )
            ->orderBy('actirovki_widget_rows.school_shift')
            ->get();

        $pivot = [];
        foreach ($rows as $row) {
            $shift = $row->getAttribute('school_shift');
            $range = (int)$row->getAttribute('school_class');
            $pivot[$shift][$range] = $row->getAttribute('total');
        }

        $shiftsData = [];
        foreach (self::SHIFTS as $shift) {
            $shiftsData[$shift] = [];
            foreach (self::SCHOOL_CLASS_RANGES as $range) {
                $shiftsData[$shift][$range] = $pivot[$shift][$range] ?? 0;
            }
        }

        return response()->json([
            'data' => [
                'shifts' => $shiftsData,
            ],
        ]);
    }


}
