<?php

namespace Modules\ActirovkiWidget\Models;

use Modules\ActirovkiWidget\Models\Base\Weather as BaseActirovkiWidgetWeather;

class Weather extends BaseActirovkiWidgetWeather
{
    protected $fillable = [
        'city_id',
        'temperature',
        'wind'
    ];
}
