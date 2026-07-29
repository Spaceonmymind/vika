<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\ActirovkiWidget\Models\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\ActirovkiWidget\Models\Row;
use Modules\ActirovkiWidget\Models\Weather;
use Modules\ActirovkiWidget\Models\WeatherRange;

/**
 * Class City
 *
 * @property int $id
 * @property string $name
 * @property string $fias_id
 *
 * @property Collection|\Modules\ActirovkiWidget\Models\Base\Row[] $actirovki_widget_rows
 * @property Collection|\Modules\ActirovkiWidget\Models\Base\WeatherRange[] $actirovki_widget_weather_ranges
 * @property Collection|\Modules\ActirovkiWidget\Models\Base\Weather[] $actirovki_widget_weathers
 *
 * @package App\Models\Base
 */
class City extends Model
{
    public $timestamps = false;
    protected $table = 'actirovki_widget_cities';

    public function actirovki_widget_rows()
    {
        return $this->hasMany(Row::class, 'city_id');
    }

    public function actirovki_widget_weather_ranges()
    {
        return $this->hasMany(WeatherRange::class, 'city_id');
    }

    public function actirovki_widget_weathers()
    {
        return $this->hasMany(Weather::class, 'city_id');
    }
}
