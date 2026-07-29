<?php

namespace Modules\SportSectionsWidget\Services;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\SportSectionsWidget\Models\Section;
use Modules\SportSectionsWidget\Models\Sport;

class SportSectionsWidgetService
{
    public function getSportTypes(?int $cityId): Collection
    {
        if ($cityId) {
            $sportIds = Section::query()
                ->where('city_id', $cityId)
                ->pluck('sport_id')
                ->unique()
                ->values();

            return Sport::query()
                ->whereIn('id', $sportIds)
                ->get();
        }
        return Sport::query()
            ->get();

    }

    public function getSections(?int $cityId, ?int $sportId, ?int $age): CursorPaginator
    {
        return Section::query()
            ->with(['sport',
                    'trainer',
                    'city:id,name',
                    'schedule',
                    'organisation' => function ($q) {
                        $q->with(['city:id,name']);
                    },
                    'municipality'
                ]
            )
            ->when(isset($cityId), function (Builder $q) use ($cityId) {
                $q->where('city_id', $cityId);
            })
            ->when(isset($sportId), function (Builder $q) use ($sportId) {
                $q->where('sport_id', $sportId);
            })
            ->when(isset($age), function (Builder $q) use ($age) {
                $q
                    ->where('age_min', '<=', $age)
                    ->where('age_max', '>=', $age);
            })
            ->cursorPaginate(30);
    }
}
