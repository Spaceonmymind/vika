<?php

namespace Modules\ITSupportWidget\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Modules\ITSupportWidget\Models\ItSupportWidgetMeasure;

class ITSupportWidgetService
{

    /**
     * Возвращает меры поддержки в сфере it
     * @param $name
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMeasures($name = null)
    {
        return ItSupportWidgetMeasure::query()
            ->when(isset($name), function (Builder $q) use ($name) {
                $q->where('name', 'like', '%' . $name . '%');
            })
            ->get();
    }
}
