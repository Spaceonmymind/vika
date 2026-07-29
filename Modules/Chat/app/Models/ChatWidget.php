<?php

namespace Modules\Chat\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\URL;
use Modules\Chat\Models\Base\ChatWidget as BaseChatWidget;

/**
 * Class ChatWidget
 *
 * @property int $id
 * @property string $code_name
 * @property string $name
 * @property string|null $description
 * @property bool $is_active
 * @property int $type_id
 * @property int|null $category_id
 * @property int|null $icon_id
 * @property int|null $order
 * @property string|null $bg_colour
 * @property bool $is_favorite
 * @property string|null $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property ChatWidgetType $type
 * @property Collection|ChatWidgetUsageHistoryRecord[] $widget_usage_history_records
 *
 * @package Modules\Chat\Models
 */
class ChatWidget extends BaseChatWidget
{
    protected $fillable = [
        'code_name',
        'name',
        'description',
        'is_active',
        'type_id',
        'category_id',
        'icon_id',
        'order',
        'bg_colour',
        'is_favorite',
        'url',
    ];

    public function widget_usage_history_records(): HasMany
    {
        return $this->hasMany(ChatWidgetUsageHistoryRecord::class, 'widget_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(ChatWidgetType::class, 'type_id');
    }

    /**
     * @return Attribute<string,never>
     */
    protected function widgetPublicUrl(): Attribute
    {
        return Attribute::make(
            get: fn()
                => config('app.env') === 'local'
                ? 'https://vi.stage.ugraphic.ru/vika/widget/proxy/' . $this->code_name
                : URL::to('/vika/widget/proxy/' . $this->code_name),
        );
    }

}
