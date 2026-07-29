<?php

namespace Modules\Chat\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\ActirovkiWidget\Models\City;

/**
 * @property int|null $school_shift
 * @property-read City|null $city
 * @property-read ChatMaxWeatherSchoolClassRange|null $school_class_range
 */
class ChatMaxWeatherSubscription extends Model
{
    public $timestamps = false;

    protected $table = 'chat_max_weather_subscriptions';

    protected $fillable = [
        'city_id',
        'school_class_range_id',
        'school_shift',
    ];

    protected $casts = [
        'city_id' => 'int',
        'school_class_range_id' => 'int',
        'school_shift' => 'int',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function school_class_range(): BelongsTo
    {
        return $this->belongsTo(ChatMaxWeatherSchoolClassRange::class, 'school_class_range_id');
    }

    public function user_subscriptions(): HasOne
    {
        return $this->hasOne(ChatMaxUserSubscription::class, 'weather_subscription_id');
    }

}
