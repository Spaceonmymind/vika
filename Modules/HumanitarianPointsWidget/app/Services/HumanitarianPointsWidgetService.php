<?php

namespace Modules\HumanitarianPointsWidget\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Modules\HumanitarianPointsWidget\Models\HumanitarianPointsWidgetHumanitarianPoint;

class HumanitarianPointsWidgetService
{

    /**
     * @param $municipalityId
     * @return Collection
     */
    public function getHumanitarianPoints($municipalityId = null)
    {
        return HumanitarianPointsWidgetHumanitarianPoint::query()
            ->with([
              'municipality'
            ])
            ->when(isset($municipalityId), function (Builder $q) use ($municipalityId) {
                $q->where('municipality_id', $municipalityId);
            })
            ->get();
    }
}
