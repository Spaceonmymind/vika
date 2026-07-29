<?php

namespace Modules\Chat\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int|null $max_class
 */
class ChatMaxWeatherSchoolClassRange extends Model
{
    protected $table = 'chat_max_weather_school_class_ranges';
    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'description',
        'max_class',
    ];

    protected $casts = [
    ];

    public function subscriptions()
    {
        return $this->hasMany(ChatMaxWeatherSubscription::class, 'school_class_range_id');
    }

}
