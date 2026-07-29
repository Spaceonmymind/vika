<?php

namespace Modules\Chat\Services;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Uri;
use Modules\Chat\Jobs\SendResponseForMessage;
use Modules\Chat\Jobs\SendWelcomeMessage;
use Modules\Chat\Models\ChatAttachedToVikaTypeWidget;
use Modules\Chat\Models\ChatHint;
use Modules\Chat\Models\ChatMessage;
use Modules\Chat\Models\ChatVikaType;
use Modules\Chat\Models\ChatWidget;
use Modules\Chat\Models\ChatWidgetCategory;
use Modules\Chat\Models\ChatWidgetUsageHistoryRecord;
use Illuminate\Support\Collection as BaseCollection;
class ChatService
{
    /**
     * Возвращает все сообщения из чата
     * @param string $chatId
     * @param string $vikaType
     * @return Paginator
     */
    public function getChatMessages(string $chatId, string $vikaType = 'main'): Paginator
    {
        $paginatedResult = ChatMessage::query()
            ->where('chat_id', $chatId)
            ->latest('id')
            ->simplePaginate(10);

        $paginatedResult
            ->setCollection(
                $paginatedResult
                    ->getCollection()
                    ->reverse()
                    ->values(),
            );

        if ($paginatedResult->isEmpty()) {
            SendWelcomeMessage::dispatch($chatId, $vikaType)->delay(1)->onQueue('incoming-chat-messages-process');
        }

        return $paginatedResult;
    }

    /**
     * Возвращает список доступных виджетов для конкретного типа Вики
     * @param $vikaType
     * @return array
     */
    public function getWidgetsList(string $vikaType): array
    {
        return [
            'favorite'=>$this->getFavoriteWidgetsAndCategories($vikaType),
            'widgets_and_categories'=>$this->getWidgetMenuItems($vikaType),

        ];
    }

    /**
     * Сохранение входящего сообщения, с последующей отправкой в очередь на обработку
     * @param string $chatId
     * @param string $message
     * @param string $vikaType
     * @return array{success: true, message_id: int}
     */
    public function handleIncomingMessage(string $chatId, string $message, string $vikaType): array
    {
        $cvt = ChatVikaType::query()->where('name', $vikaType)->first();

        abort_if(
            !isset($cvt),
            500,
            config('app.env') === 'production' ? 'Что-то пошло не так' : 'Необходимо заполнить таблицу с типами Вики',
        );

        $chatMessage = ChatMessage::create([
            'chat_id' => $chatId,
            'message' => $message,
            'vika_type_id' => $cvt->id,
        ]);

        SendResponseForMessage::dispatch($chatMessage)->onQueue('incoming-chat-messages-process');

        return [
            'success' => true,
            'message_id' => $chatMessage->id,
        ];
    }

    //Занесение всех модулей-виджетов в БД.

    /**
     * Вероятно, какой-то служебный метод
     * @return Collection
     */
    public function updateAndGetWidgetsList()
    {
        /*ChatWidget::query()->delete();

        $modules = Module::all();

        $vikaTypes = ChatVikaType::all();

        foreach ($modules as $module) {
            if (!$module->get('is_widget')) {
                continue;
            }

            $chatWidget = ChatWidget::query()->create([
                'code_name' => $module->getSnakeName(),
                'name' => $module->get('russian_name'),
                'description' => $module->getDescription(),
                'is_active' => $module->isEnabled(),
            ]);

            foreach ($module->get('vika_types') as $moduleVikaType) {
                if ($vikaTypes->contains('name', $moduleVikaType)) {
                    $vikaType = $vikaTypes->where('name', $moduleVikaType)->first();
                    $chatWidget->vika_types()->attach($vikaType);
                }
            }

        }
*/
        return ChatWidget::query()->with(['attached_to_vika_type_widgets'])->get();
    }

    /**
     * Возвращает список подсказок для чата заданного типа вики
     *
     * @param string $vikaType
     * @param string $query
     * @return \Illuminate\Database\Eloquent\Collection<int, ChatHint>
     */
    public function getChatHints(string $vikaType, string $query)
    {
        return ChatHint::query()
            ->whereHas('vika_types', function (Builder $q) use ($vikaType) {
                $q->where('name', $vikaType);
            })
            ->where('value', 'like', '%' . mb_strtolower($query) . '%')
            ->get();
    }

    /**
     * Сохраняет информацию об использовании виджета
     * @param $widgetCodeName
     * @param $chatId
     * @param $fromTg
     * @return true[]
     */
    public function createWidgetUsageRecord($widgetCodeName, $chatId, $fromTg = false,$fromMax=false): array
    {
        ChatWidgetUsageHistoryRecord::create([
            'chat_id' => $chatId,
            'widget_id' => ChatWidget::query()->where('code_name', $widgetCodeName)->first()->id,
            'from_tg' => $fromTg,
            'from_max'=>$fromMax,
            'called_at' => Carbon::now(),
        ]);

        return ['success' => true];
    }

    /**
     * Возвращает информацию о виджете по его коду
     * @param ChatWidget $widget
     * @return ChatWidget
     */
    public function getWidgetInfoByCode(ChatWidget $widget)
    {
        return $widget->load([
            'icon',
            'type',
        ]);
    }

    /**
     * Возвращает тип Вики, по ссылке, на которой находится виджет
     * @param string $resourceUrl
     * @return mixed|\Modules\Chat\Models\Base\ChatVikaType|ChatVikaType
     */
    public function getVikaTypeByResourceUrl(string $resourceUrl)
    {
        $vikaType = ChatVikaType::query()
            ->select(['id', 'name', 'description'])
            ->whereHas('resources', function (Builder $q) use ($resourceUrl) {
                $q->where('resource_host', Uri::of($resourceUrl)->host());
            })->first();

        if (!$vikaType instanceof ChatVikaType) {
            $vikaType = ChatVikaType::query()
                ->select(['id', 'name', 'description'])
                ->where('name', 'main')
                ->first();
        }

        return $vikaType;
    }

    /**
     * Возвращает набор категорий и виджетов для панели быстрого доступа(избранного)
     * @param string $vikaType
     * @return BaseCollection
     */
    public function getFavoriteWidgetsAndCategories(string $vikaType)
    {
        $favoriteWidgets = ChatAttachedToVikaTypeWidget::query()
            ->where('is_favorite', true)
            ->whereHas('vika_type', function (Builder $q) use ($vikaType) {
                $q->where('name', $vikaType);
            })
            ->with([
                'widget:id,type_id,code_name,name,description,url,bg_colour,icon_id,is_active',
                'widget.icon',
                'widget.type',
            ])
            ->whereHas('widget', function (Builder $q) {
                $q->where('is_active', true);
            })
            ->orderBy('order')
            ->orderBy('id')
            ->get()->map(function ($item) {
                $item = $item->toArray();
                $item['is_widget'] = true;
                return $item;
            });

        $favoriteCategories = ChatWidgetCategory::query()
            ->where('is_favorite', true)
            ->whereHas('vika_type', function (Builder $q) use ($vikaType) {
                $q->where('name', $vikaType);
            })
            ->whereHas('attached_to_vika_type_widgets', function (Builder $q) {
                $q->whereHas('widget', function (Builder $q) {
                    $q->where('is_active', true);
                });
            })
            ->with([
                'icon',
            ])
            ->orderBy('order')->get()->map(function ($item) {
                $item = $item->toArray();
                $item['is_widget'] = false;
                return $item;
            });

        return  $favoriteWidgets->concat($favoriteCategories->all())->sortBy(['order', 'id'])->values();

    }

    /**
     * Возвращает элементы меню виджетов
     * @param string $vikaType
     * @return BaseCollection
     */
    public function getWidgetMenuItems(string $vikaType)
    {
        $widgetsInCategories = ChatWidgetCategory::query()
            ->whereHas('vika_type', function (Builder $q) use ($vikaType) {
                $q->where('name', $vikaType);
            })
            ->whereHas('attached_to_vika_type_widgets', function (Builder $q) {
                $q->whereHas('widget', function (Builder $q) {
                    $q->where('is_active', true);
                });
            })
            ->with([
                'icon',
                'attached_to_vika_type_widgets' => function (Builder $q) {
                    $q
                        ->orderBy('order')
                        ->orderBy('id');
                },
                'attached_to_vika_type_widgets.widget:id,type_id,code_name,name,description,url,bg_colour,icon_id,is_active',
                'attached_to_vika_type_widgets.widget.icon',
                'attached_to_vika_type_widgets.widget.type',
            ])
            ->orderBy('order')->get()->map(function ($item) {
                $item = $item->toArray();
                $item['is_widget'] = false;
                return $item;
            });

        $widgetsWithoutCategory = ChatAttachedToVikaTypeWidget::query()
            ->whereHas('vika_type', function (Builder $q) use ($vikaType) {
                $q->where('name', $vikaType);
            })
            ->with([
                'widget:id,type_id,code_name,name,description,url,bg_colour,icon_id,is_active',
                'widget.icon',
                'widget.type',
            ])
            ->whereNull('category_id')
            ->whereHas('widget', function (Builder $q) {
                $q->where('is_active', true);
            })
            ->orderBy('order')
            ->orderBy('id')
            ->get()->map(function ($item) {
                $item = $item->toArray();
                $item['is_widget'] = true;
                return $item;
            });

        return $widgetsInCategories->concat($widgetsWithoutCategory->all())->sortBy('order')->values();
    }
}
