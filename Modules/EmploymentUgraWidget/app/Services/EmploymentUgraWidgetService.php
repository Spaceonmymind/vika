<?php

namespace Modules\EmploymentUgraWidget\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Modules\EmploymentUgraWidget\Models\EmploymentUgraWidgetCategory;
use Modules\EmploymentUgraWidget\Models\EmploymentUgraWidgetQuestion;

class EmploymentUgraWidgetService
{
    /**
     * Возвращает категории вопросов по занятости в Югре
     * @return Collection
     */
    public function getCategories(): Collection
    {
        return EmploymentUgraWidgetCategory::all();
    }

    /**
     * Возвращает вопросы с ответами по занятости в Югре
     * @param int|null $categoryId
     * @return Collection
     */
    public function getQuestions(?int $categoryId): Collection
    {
        return EmploymentUgraWidgetQuestion::query()
            ->when(isset($categoryId),function (Builder $q)use ($categoryId){
                $q->where('category_id', $categoryId);
            })
            ->get();
    }
}
