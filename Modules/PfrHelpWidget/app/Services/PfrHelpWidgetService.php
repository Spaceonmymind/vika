<?php

namespace Modules\PfrHelpWidget\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Modules\PfrHelpWidget\Models\PfrHelpWidgetQuestion;
use Modules\PfrHelpWidget\Models\PfrHelpWidgetQuestionCategory;
use Modules\PfrHelpWidget\Models\PfrHelpWidgetService as PfrHelpWidgetServiceModel;

class PfrHelpWidgetService {

    public function getServices()
    {
        return PfrHelpWidgetServiceModel::query()
            ->get();
    }
    public function getCategories(?int $serviceId)
    {
        return PfrHelpWidgetQuestionCategory::query()
            ->when(isset($serviceId),function (Builder $q)use ($serviceId) {
                $q->where('service_id', $serviceId);
            })
            ->get();
    }
    public function getQuestions(?int $categoryId,?int $serviceId)
    {
        return PfrHelpWidgetQuestion::query()
            ->when(isset($categoryId),function (Builder $q)use ($categoryId){
                $q->where('category_id', $categoryId);
            })
            ->when(isset($serviceId),function (Builder $q)use ($serviceId){
                $q->whereHas('category',function (Builder $q)use ($serviceId){
                   $q->where('service_id', $serviceId);
                });
            })
            ->get();
    }
}
