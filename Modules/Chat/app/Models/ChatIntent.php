<?php

namespace Modules\Chat\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Chat\Models\Base\ChatIntent as BaseChatIntent;

class ChatIntent extends BaseChatIntent
{
    protected $fillable = [
        'code',
        'name',
        'custom_handler_class',
        'active',
        'external_id',
        'handler_id',
        'system_prompt',
        'document',
    ];

    public function history_records(): HasMany
    {
        return $this->hasMany(ChatIntentHistoryRecord::class, 'intent_id');
    }

    public function test_requests(): HasMany
    {
        return $this->hasMany(ChatIntentTestRequest::class, 'intent_id');
    }

    public function active_vika_types(): BelongsToMany
    {
        return $this->belongsToMany(ChatVikaType::class, 'chat_answers', 'intent_id', 'vika_type_id')->where('chat_answers.is_active', true);
    }


}
