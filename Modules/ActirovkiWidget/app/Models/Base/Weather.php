<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\ActirovkiWidget\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\ActirovkiWidget\Models\City;
use Modules\ActirovkiWidget\Models\Row;

/**
 * Class Weather
 *
 * @property int $id
 * @property int $city_id
 * @property float $temperature
 * @property float $wind
 * @property Carbon $created_at
 * @property Carbon $received_at
 *
 * @property \Modules\ActirovkiWidget\Models\Base\City $city
 * @property Collection|\Modules\ActirovkiWidget\Models\Base\Row[] $rows
 *
 * @package App\Models\Base
 */
class Weather extends Model
{
    const ?string UPDATED_AT = null;

    protected $table = 'actirovki_widget_weathers';
    protected $casts = [
        'city_id' => 'int',
        'temperature' => 'float',
        'wind' => 'float',
        'received_at' => 'datetime'
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function row(): HasOne
    {
        return $this->hasOne(Row::class, 'weather_id');
    }
}
