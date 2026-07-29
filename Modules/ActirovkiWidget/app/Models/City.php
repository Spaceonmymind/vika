<?php

namespace Modules\ActirovkiWidget\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Cache;
use Modules\ActirovkiWidget\Cache\Keys;
use Modules\ActirovkiWidget\Models\Base\City as BaseActirovkiWidgetCity;

/**
 * App\Models\City
 *
 * @property-read Row|null $latestActirovkiWidgetRow
 */
class City extends BaseActirovkiWidgetCity
{
    protected $fillable = [
        'name',
        'fias_id'
    ];

    protected static function booted(): void
    {
        static::saved(static fn() => Cache::forget(Keys::cities()));
        static::updated(static fn() => Cache::forget(Keys::cities()));
        static::deleted(static fn() => Cache::forget(Keys::cities()));
    }

    public function latestActirovkiWidgetRow(): HasOne
    {
        return $this->hasOne(Row::class)
            ->whereDate('created_at', today())
            ->whereNull('cancel_user_id')
            ->whereNull('cancel_at')
            ->latestOfMany('created_at');
    }
}
