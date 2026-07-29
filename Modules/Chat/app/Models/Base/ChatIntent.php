<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Chat\Models\ChatAnswer;
use Modules\Chat\Models\ChatIntentHandler;
use Modules\Chat\Models\ChatVikaType as ChatVikaTypeAlias;

/**
 * Class ChatIntent
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $custom_handler_class
 * @property bool $active
 * @property int $external_id
 *
 * @property Collection|\Modules\Chat\Models\Base\ChatAnswer[] $chat_answers
 * @property ChatVikaTypeAlias $chat_intent_vika_type
 * @property ChatIntentHandler|null $handler
 *
 * @package App\Models\Base
 */
class ChatIntent extends Model
{
    public $timestamps = false;
    protected $table = 'chat_intents';
    protected $casts = [
        'active' => 'bool',
        'external_id' => 'integer',
        'handler_id' => 'integer',
    ];

    public function chat_answers(): HasMany
    {
        return $this->hasMany(ChatAnswer::class, 'intent_id');
    }
    public function handler(): BelongsTo
    {
        return $this->belongsTo(ChatIntentHandler::class, 'handler_id');
    }
}
