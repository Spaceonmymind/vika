<?php

namespace Modules\SocialSupportWidget\Services;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Modules\SocialSupportWidget\Models\SocialSupportWidgetPreferentialCategory;
use Modules\SocialSupportWidget\Models\SocialSupportWidgetSituation;
use Modules\SocialSupportWidget\Models\SocialSupportWidgetSocialSupportMeasure;

class SocialSupportWidgetService
{
    /**
     * Возвращает список льготных категорий
     * @return Collection
     */
    public function getPreferentialCategories()
    {
        return SocialSupportWidgetPreferentialCategory::query()
            ->whereHas('support_measures')
            ->get();
    }

    /**
     * Возвращает список жизненных ситуаций
     * @return Collection
     */
    public function getSituations()
    {
        return SocialSupportWidgetSituation::query()
            ->whereHas('support_measures')
            ->get();
    }

    /**
     * Возвращает меры поддержки
     * @param $filters
     * @return Collection
     */
    public function getMeasures($filters = [])
    {
        return SocialSupportWidgetSocialSupportMeasure::query()
            ->select([
                'id',
                'situation_id',
                'name',
                'conditions',
                'amount_and_deadlines',
                'law',
                'create_date',
                'update_date',
                'epgu_link',
                'live_in_ugra_years',
                'max_family_income',
                'max_child_age',
                'min_amount',
                'max_amount'
            ])
            ->with([
                'situation',
                'preferential_categories'
            ])
            ->when(isset($filters['situation_id']), function (Builder $q) use ($filters) {
                $q->where('situation_id', $filters['situation_id']);
            })
            ->when(!empty($filters['preferential_categories']), function (Builder $q) use ($filters) {
                $q->where(function (Builder $q) use ($filters) {
                    $q
                        ->whereHas('preferential_categories', function (Builder $q) use ($filters) {
                            $q->whereIn('id', $filters['preferential_categories']);
                        })
                        ->orWhereDoesntHave('preferential_categories');
                });

            })
            ->when(isset($filters['date_relocation']), function (Builder $q) use ($filters) {

                $q->where(function (Builder $q) use ($filters) {

                    $q
                        ->where('live_in_ugra_years', '<=', floor((Carbon::parse($filters['date_relocation'])->diffInYears(absolute: true))))
                        ->orWhereNull('live_in_ugra_years');
                });

            })
            ->when(isset($filters['child_birthday']), function (Builder $q) use ($filters) {
                $q->where(function (Builder $q) use ($filters) {
                    $q
                        ->where(function (Builder $q) use ($filters) {
                            $q
                                ->where('min_child_age', '<=', Carbon::parse($filters['child_birthday'])->diffInMonths(absolute: true))
                                ->orWhereNull('min_child_age');
                        })
                        ->where(function (Builder $q) use ($filters) {
                            $q
                                ->where('max_child_age', '>=', Carbon::parse($filters['child_birthday'])->diffInMonths(absolute: true))
                                ->orWhereNull('max_child_age');
                        });

                });
            })
            ->when(isset($filters['income']) && isset($filters['family_members_count']), function (Builder $q) use ($filters) {
                $q->where(function (Builder $q) use ($filters) {
                    $q
                        ->where('max_family_income', '>=', $filters['income'] / $filters['family_members_count'])
                        ->orWhereNull('max_family_income');
                });
            })
            ->get();
    }
}
