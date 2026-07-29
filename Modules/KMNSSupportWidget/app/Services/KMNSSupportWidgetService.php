<?php

namespace Modules\KMNSSupportWidget\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Modules\KMNSSupportWidget\Models\KmnsSupportWidgetMeasure;

class KMNSSupportWidgetService
{

    /**
     * Возвращает меры поддержки КМНС
     * @param $name
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMeasures($name = null, $activityTypeId = null)
    {
        return KmnsSupportWidgetMeasure::query()
            ->with([
                'activity_type',
            ])
            ->when(isset($name), function (Builder $q) use ($name) {
                $q->where('name', 'like', '%' . $name . '%');
            })
            ->when(isset($activityTypeId), function (Builder $q) use ($activityTypeId) {
                $q->where('activity_type_id', $activityTypeId);
            })
            ->get();
    }

}
