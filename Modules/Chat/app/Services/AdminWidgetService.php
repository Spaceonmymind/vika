<?php

namespace Modules\Chat\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Chat\Models\ChatAttachedToVikaTypeWidget;
use Modules\Chat\Models\ChatVikaType;
use Modules\Chat\Models\ChatWidget;
use Modules\Chat\Models\ChatWidgetCategory;

class AdminWidgetService
{

    /**
     * Добавляет категорию виджетов к определённому Типу Вики
     * @param ChatVikaType $chatVikaType
     * @param array $widgetCategoryAttributes
     * @return array
     */
    public function addWidgetCategoryToVikaType(ChatVikaType $chatVikaType, array $widgetCategoryAttributes)
    {
        /**
         * @var ChatWidgetCategory $category
         */
        $category = $chatVikaType->widget_categories()->create($widgetCategoryAttributes);
        return [
            'success' => true,
            'category_id' => $category->id,
        ];
    }

    /**
     * Обновляет категорию виджетов
     * @param ChatWidgetCategory $chatWidgetCategory
     * @param array $widgetCategoryAttributes
     * @return true[]
     */
    public function updateWidgetCategory(ChatWidgetCategory $chatWidgetCategory, array $widgetCategoryAttributes)
    {
        $chatWidgetCategory->update($widgetCategoryAttributes);
        return ['success' => true];
    }

    /**
     * Удаляет категорию виджетов
     * @param ChatWidgetCategory $chatWidgetCategory
     * @return true[]
     */
    public function deleteWidgetCategory(ChatWidgetCategory $chatWidgetCategory)
    {
        $chatWidgetCategory->delete();
        return ['success' => true];
    }

    /**
     * Возвращает все доступные категории виджетов
     * @param ChatVikaType $chatVikaType
     * @return ChatWidgetCategory[]|Collection
     */
    public function getVikaTypeWidgetCategories(ChatVikaType $chatVikaType)
    {
        $chatVikaType->load('widget_categories.icon');

        return $chatVikaType->widget_categories;
    }

    /**
     * Создаёт новый виджет(ссылочный)
     * @param array $widgetAttributes
     * @return true[]
     */
    public function createWidget(array $widgetAttributes)
    {
        ChatWidget::query()->create($widgetAttributes);

        return ['success' => true];
    }

    /**
     * Обновляет виджет
     * @param ChatWidget $chatWidget
     * @param array $widgetAttributes
     * @return true[]
     */
    public function updateWidget(ChatWidget $chatWidget, array $widgetAttributes)
    {
        $chatWidget->update($widgetAttributes);
        return ['success' => true];
    }

    /**
     * Удаляет виджет(ссылочный)
     * @param ChatWidget $chatWidget
     * @return array
     */
    public function deleteWidget(ChatWidget $chatWidget)
    {
        if ($chatWidget->type_id == 1) {
            return [
                'success' => false,
                'error' => 'Нельзя удалить виджет типа "Системный"',
            ];
        }
        $chatWidget->delete();
        return ['success' => true];
    }

    /**
     * Возвращает список виджетов
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator|\Modules\Chat\Models\Base\ChatWidget[]|ChatWidget[]|Collection
     */
    public function getWidgets(array $filters = [])
    {
        $query = ChatWidget::query()
            ->select([
                'id',
                'code_name',
                'name',
                'description',
                'is_active',
                'type_id',
                'icon_id',
                'bg_colour',
            ])
            ->with([
                'icon',
                'type',
            ])
            ->when(!empty($filters['exclude_vika_types']), function (Builder $q) use ($filters) {
                $q->whereDoesntHave('attached_to_vika_type_widgets', function (Builder $q) use ($filters) {
                    $q->whereIn('vika_type_id', $filters['exclude_vika_types']);
                });
            })
            ->when(!empty($filters['include_vika_types']), function (Builder $q) use ($filters) {
                $q->whereHas('attached_to_vika_type_widgets', function (Builder $q) use ($filters) {
                    $q->whereIn('vika_type_id', $filters['include_vika_types']);
                });
            })
            ->when(isset($filters['is_active']), function (Builder $q) use ($filters) {
                $q->where('is_active', $filters['is_active']);
            })
            ->when(isset($filters['type_id']), function (Builder $q) use ($filters) {
                $q->where('type_id', $filters['type_id']);
            })
            ->when(isset($filters['query']), function (Builder $q) use ($filters) {
                $q->where(function (Builder $q) use ($filters) {
                    $q
                        ->where('name', 'like', '%' . $filters['query'] . '%')
                        ->orWhere('code_name', 'like', '%' . $filters['query'] . '%');
                });
            });

        if ($filters['need_pagination'] ?? false) {
            return $query->paginate($filters['per_page'] ?? 15);
        }

        return $query->get();
    }

    /**
     * Возвращает деталку виджета
     * @param ChatWidget $chatWidget
     * @return ChatWidget
     */
    public function getWidget(ChatWidget $chatWidget)
    {
        return $chatWidget
            ->load([
                'icon',
                'type',
                'attached_to_vika_type_widgets',
                'attached_to_vika_type_widgets.category.icon',
                'attached_to_vika_type_widgets.vika_type',
            ])
            ->loadCount('widget_usage_history_records as usage_count');
    }

    /**
     * Привязывает виджет к типу Вики
     * @param array $attachedToVikaTypeAttributes
     * @return true[]
     */
    public function addWidgetToVikaType(array $attachedToVikaTypeAttributes)
    {
        ChatAttachedToVikaTypeWidget::query()->create($attachedToVikaTypeAttributes);

        return ['success' => true];
    }

    /**
     * Обновляет информацию о привязке виджета к типу Вики(категория и т.д.)
     * @param ChatAttachedToVikaTypeWidget $attachedToVikaTypeWidget
     * @param array $attributes
     * @return true[]
     */
    public function updateAttachedToVikaTypeWidget(ChatAttachedToVikaTypeWidget $attachedToVikaTypeWidget, array $attributes)
    {
        $attachedToVikaTypeWidget->update($attributes);
        return ['success' => true];
    }

    /**
     * Отвязывает виджет от типа Вики
     * @param ChatAttachedToVikaTypeWidget $attachedToVikaTypeWidget
     * @return true[]
     */
    public function deleteAttachedToVikaTypeWidget(ChatAttachedToVikaTypeWidget $attachedToVikaTypeWidget)
    {
        $attachedToVikaTypeWidget->delete();

        return ['success' => true];
    }

}
