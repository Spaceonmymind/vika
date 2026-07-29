<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Chat\Models\ChatAnswerButton;
use Modules\Chat\Models\ChatAnswerText as ChatAnswerTextAlias;
use Modules\Chat\Models\ChatIntent;
use Modules\Chat\Models\ChatVikaType;

/**
 * Class ChatAnswer
 *
 * @property int $id
 * @property string $name
 * @property int $intent_id
 * @property int $vika_type_id
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property \Modules\Chat\Models\ChatIntent $chat_intent
 * @property \Modules\Chat\Models\ChatVikaType $vika_type
 * @property Collection|\Modules\Chat\Models\ChatAnswerButton[] $chat_answer_buttons
 * @property Collection|\Modules\Chat\Models\ChatAnswerText[] $chat_answer_texts
 *
 * @package App\Models\Base
 */
class ChatAnswer extends Model
{
    protected $table = 'chat_answers';

    protected $casts = [
        'intent_id' => 'int',
        'vika_type_id' => 'int',
        'is_active' => 'bool',
    ];

    public function chat_intent(): BelongsTo
    {
        return $this->belongsTo(ChatIntent::class, 'intent_id');
    }

    public function chat_answer_buttons(): HasMany
    {
        return $this->hasMany(ChatAnswerButton::class, 'answer_id');
    }

    public function vika_type(): BelongsTo
    {
        return $this->belongsTo(ChatVikaType::class, 'vika_type_id');
    }

    public function chat_answer_texts(): HasMany
    {
        return $this->hasMany(ChatAnswerTextAlias::class, 'answer_id');
    }
}
