<?php

namespace Modules\ActirovkiWidget\Models;

use Modules\ActirovkiWidget\Models\Base\WeatherRange as BaseActirovkiWidgetWeatherRange;

class WeatherRange extends BaseActirovkiWidgetWeatherRange
{
    protected $fillable = [
        'city_id',
        'temperature',
        'wind',
        'school_class'
    ];

    /**
     * Возвращает первый диапазон актировки, удовлетворяющий переданной погоде.
     */
    public static function matchingForWeather(Weather $weather): ?self
    {
        return self::query()
            ->where('city_id', $weather->city_id)
            ->where('temperature', '>=', $weather->temperature)
            ->where('wind', '<=', $weather->wind)
            ->orderByDesc('school_class')
            ->first();
    }
}
