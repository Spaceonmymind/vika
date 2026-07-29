<?php

namespace Modules\Chat\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Chat\Models\Base\ChatVikaType as BaseChatVikaType;

class ChatVikaType extends BaseChatVikaType
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function attached_to_vika_type_widgets(): HasMany
    {
        return $this->hasMany(ChatAttachedToVikaTypeWidget::class, 'vika_type_id');
    }

    public function chat_answers(): HasMany
    {
        return $this->hasMany(ChatAnswer::class, 'vika_type_id');
    }
    public function resources():HasMany
    {
        return $this->hasMany(ChatVikaTypeResource::class, 'vika_type_id');
    }
    public function widget_categories(): HasMany
    {
        return $this->hasMany(ChatWidgetCategory::class, 'vika_type_id');
    }
}
