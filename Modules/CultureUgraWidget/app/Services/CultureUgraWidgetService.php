<?php

namespace Modules\CultureUgraWidget\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Modules\CultureUgraWidget\Models\CultureUgraWidgetEvent;

class CultureUgraWidgetService
{
    public function getEvents($localityId = null)
    {
        return CultureUgraWidgetEvent::query()
            ->with([
                'locality',
            ])
            ->when(isset($localityId), function (Builder $q) use ($localityId) {
                $q->where('locality_id', $localityId);
            })
            ->get();
    }
}
