<?php

namespace Modules\Chat\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Modules\Chat\Models\ChatAttachedToVikaTypeWidget;
use Modules\Chat\Models\ChatIntent;
use Modules\Chat\Models\ChatVikaType;
use Modules\Chat\Models\ChatWidgetCategory;

class AdminVikaTypeService
{
    private const DEFAULT_WELCOME_MESSAGE_TEXT = 'Привет!<br>
Я могу дать совет по использованию электронных услуг, найти спортивную секцию, медицинский участок, события в культурной жизни Югры, статус заявления в МФЦ и многое другое.';
    private const DEFAULT_FALLBACK_MESSAGE_TEXT = 'Извините, я кажется вас не поняла';
    private TolyaClassifierService $tolyaClassifierService;

    /**
     * @param TolyaClassifierService $tolyaClassifierService
     */
    public function __construct(TolyaClassifierService $tolyaClassifierService)
    {
        $this->tolyaClassifierService = $tolyaClassifierService;
    }

    /**
     * Создает новый тип вики, попутно создавая его в нейросети
     * @param string $description
     * @param string $name
     * @param array $resources
     * @return array
     */
    public function createVikaType(string $description, string $name, array $resources)
    {
        if (!$this->tolyaClassifierService->createVikaType($description, $name)) {
            return [
                'success' => false,
                'error' => 'Не удалось установить соединение с нейросетью',
            ];
        }

        $vikaType = ChatVikaType::query()->create([
            'description' => $description,
            'name' => $name,
        ]);

        $this->saveVikaTypeResources($vikaType, $resources);

        $this->addSystemIntentAnswersForVikaType($vikaType);
        return ['success' => true];
    }

    /**
     * Сохраняет список ресурсов, с которых доступен определённый тип Вики
     * @param ChatVikaType $chatVikaType
     * @param array $resources
     * @return void
     */
    private function saveVikaTypeResources(ChatVikaType $chatVikaType, array $resources)
    {
        $chatVikaType->resources()->delete();

        foreach ($resources as $resource) {
            if(isset($resource)){
                $chatVikaType->resources()->create([
                    'resource_host' => $resource,
                ]);
            }
        }

    }

    /**
     * Добавляет системные интенты(приветственный и когда не удалось определить интент), для нового типа Вики
     * @param ChatVikaType $chatVikaType
     * @return void
     */
    private function addSystemIntentAnswersForVikaType(ChatVikaType $chatVikaType)
    {
        $chatService = new AdminChatService($this->tolyaClassifierService);

        $helloIntent = ChatIntent::query()->where('code', 'welcome')->first();
        $fallbackIntent = ChatIntent::query()->where('code', 'input.unknown')->first();

        $chatService->createAnswer([
            'intent_id' => $helloIntent->id,
            'name' => 'Стандартный приветственный ответ для ' . $chatVikaType->description . '[Заглушка]',
            'is_active' => true,
            'vika_type_id' => $chatVikaType->id,
        ],
            [self::DEFAULT_WELCOME_MESSAGE_TEXT],
            [],
        );

        $chatService->createAnswer([
            'intent_id' => $fallbackIntent->id,
            'name' => 'Стандартный приветственный ответ для ' . $chatVikaType->description . '[Заглушка]',
            'is_active' => true,
            'vika_type_id' => $chatVikaType->id,
        ],
            [self::DEFAULT_FALLBACK_MESSAGE_TEXT],
            [],
        );
    }

    /**
     * Обновляет тип вики, попутно обновляя его название в нейросети
     * @param ChatVikaType $chatVikaType
     * @param string $description
     * @param array $resources
     * @return array
     */
    public function updateVikaType(ChatVikaType $chatVikaType, string $description, array $resources = [])
    {
        if (!$this->tolyaClassifierService->updateVikaType($description, $chatVikaType->name)) {
            return [
                'success' => false,
                'error' => 'Не удалось установить соединение с нейросетью',
            ];
        }
        $chatVikaType->update([
            'description' => $description,
        ]);

        $this->saveVikaTypeResources($chatVikaType, $resources);

        return ['success' => true];
    }

    /**
     * Удаляет тип Вики, в т.ч. в нейросети
     * @param ChatVikaType $chatVikaType
     * @return array
     */
    public function deleteVikaType(ChatVikaType $chatVikaType)
    {
        if ($chatVikaType->id == 1) {
            return [
                'success' => false,
                'error' => 'Нельзя удалить тип вики по умолчанию',
            ];
        }

        if (!$this->tolyaClassifierService->deleteVikaType($chatVikaType->name)) {

            $chatVikaType->resources()->delete();

            return [
                'success' => false,
                'error' => 'Не удалось установить соединение с нейросетью. Все ресурсы данного типа вики были удалены.',
            ];

        }

        $chatVikaType->delete();

        return ['success' => true];
    }

    /**
     * Возвращает деталку типа Вики
     * @param ChatVikaType $chatVikaType
     * @return ChatVikaType
     */
    public function getVikaType(ChatVikaType $chatVikaType)
    {
        return $chatVikaType->load([
            'widget_categories' => function (Builder $q) {
                $q->orderBy('order');

            },
            'widget_categories.icon',
            'attached_to_vika_type_widgets' => function (Builder $q) {
                $q->orderBy('order');
            },
            'attached_to_vika_type_widgets.category',
            'attached_to_vika_type_widgets.widget.icon',
            'attached_to_vika_type_widgets.widget.type',
            'resources',
        ]);
    }

    /**
     * Возвращает список типов Вики
     * @param $needPagination
     * @param $perPage
     * @param $excludeWidgets
     * @return \Modules\Chat\Models\Base\ChatVikaType[]|ChatVikaType[]|LengthAwarePaginator|Collection
     */
    public function getVikaTypes($needPagination = false, $perPage = 15, $excludeWidgets = [], $searchQuery = null)
    {
        $query = ChatVikaType::query()
            ->when(!empty($excludeWidgets), function (Builder $q) use ($excludeWidgets) {
                $q->whereDoesntHave('attached_to_vika_type_widgets', function (Builder $q) use ($excludeWidgets) {
                    $q->whereIn('chat_widget_id', $excludeWidgets);
                });
            })
            ->when(isset($searchQuery),function (Builder $q)use ($searchQuery){
                $q->where(function (Builder $q) use ($searchQuery) {
                    $q
                        ->where('name', 'like', '%' . $searchQuery . '%')
                        ->orWhere('description', 'like', '%' . $searchQuery . '%');
                });
            });

        if ($needPagination) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    /**
     * Возвращает список виджетов, как на публичке, но с неактивными виджетами и категориями без виджетов
     * @param ChatVikaType $chatVikaType
     * @return mixed
     */
    public function getVikaTypeWidgetsMenu(ChatVikaType $chatVikaType)
    {
        $widgetsInCategories = ChatWidgetCategory::query()
            ->where('vika_type_id',$chatVikaType->id)
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
            ->where('vika_type_id',$chatVikaType->id)
            ->with([
                'widget:id,type_id,code_name,name,description,url,bg_colour,icon_id,is_active',
                'widget.icon',
                'widget.type',
            ])
            ->whereNull('category_id')
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
