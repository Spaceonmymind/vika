<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\ActirovkiWidget\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\ActirovkiWidget\Models\City;
use Modules\ActirovkiWidget\Models\Weather;
use Modules\ActirovkiWidget\Models\WeatherRange;
use Modules\Admin\Models\User;

/**
 * Class Row
 *
 * @property int $id
 * @property int $city_id
 * @property int $weather_id
 * @property int $weather_range_id
 * @property int|null $cancel_user_id
 * @property int $school_shift
 * @property Carbon $created_at
 * @property Carbon|null $cancel_at
 * @property Carbon|null $send_at
 *
 * @property User|null $cancel_user
 * @property \Modules\ActirovkiWidget\Models\Base\City $city
 * @property \Modules\ActirovkiWidget\Models\Base\Weather $weather
 * @property \Modules\ActirovkiWidget\Models\Base\WeatherRange $weather_range
 *
 * @package App\Models\Base
 */
class Row extends Model
{
    const ?string UPDATED_AT = null;

    protected $table = 'actirovki_widget_rows';
    protected $casts = [
        'city_id' => 'int',
        'weather_id' => 'int',
        'weather_range_id' => 'int',
        'cancel_user_id' => 'int',
        'school_shift' => 'int',
        'cancel_at' => 'immutable_datetime:d.m.Y H:i:s',
        'send_at' => 'immutable_datetime:d.m.Y H:i:s'
    ];

    public function cancel_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cancel_user_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function weather(): BelongsTo
    {
        return $this->belongsTo(Weather::class, 'weather_id');
    }

    public function weather_range(): BelongsTo
    {
        return $this->belongsTo(WeatherRange::class, 'weather_range_id');
    }
}
