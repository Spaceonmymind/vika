<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\ActirovkiWidget\Models\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\ActirovkiWidget\Models\City;
use Modules\ActirovkiWidget\Models\Row;

/**
 * Class WeatherRange
 *
 * @property int $id
 * @property int $city_id
 * @property float $temperature
 * @property float $wind
 * @property int $school_class
 *
 * @property \Modules\ActirovkiWidget\Models\Base\City $city
 * @property Collection|\Modules\ActirovkiWidget\Models\Base\Row[] $rows
 *
 * @package App\Models\Base
 */
class WeatherRange extends Model
{
    public $timestamps = false;
    protected $table = 'actirovki_widget_weather_ranges';
    protected $casts = [
        'city_id' => 'int',
        'temperature' => 'float',
        'wind' => 'float',
        'school_class' => 'int'
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function rows()
    {
        return $this->hasMany(Row::class, 'weather_range_id');
    }
}
