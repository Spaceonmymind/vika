<?php

namespace Modules\ActirovkiWidget\Models;

use Illuminate\Database\Eloquent\Builder;
use Modules\ActirovkiWidget\Models\Base\Row as BaseActirovkiWidgetRow;

/**
 * App\Models\Row
 *
 * @method static Builder active()
 */
class Row extends BaseActirovkiWidgetRow
{
    protected $fillable = [
        'city_id',
        'weather_id',
        'weather_range_id',
        'school_shift',
    ];

    /**
     * Пометить запись отменённой и сохранить.
     *
     * @param int $userId
     * @return static
     */
    public function cancelBy(int $userId): static
    {
        $this->cancel_user_id = $userId;
        $this->cancel_at = now();

        return $this;
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query
            ->whereNull('cancel_user_id')
            ->whereNull('cancel_at');
    }

}
