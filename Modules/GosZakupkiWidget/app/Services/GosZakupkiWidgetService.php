<?php

namespace Modules\GosZakupkiWidget\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Modules\GosZakupkiWidget\Models\GosZakupkiWidgetQuestion;

class GosZakupkiWidgetService
{

    public function getQuestions($categoryId = null)
    {
        return GosZakupkiWidgetQuestion::query()
            ->with(['category'])
            ->when(isset($categoryId), function (Builder $q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            })
            ->get();
    }
}
