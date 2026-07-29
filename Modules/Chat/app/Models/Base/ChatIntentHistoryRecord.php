<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Chat\Models\ChatIntent;
use Modules\Chat\Models\ChatVikaType as ChatVikaTypeAlias;

/**
 * Class ChatIntentHistoryRecord
 *
 * @property int $id
 * @property int|null $intent_id
 * @property string $intent_code
 * @property string $intent_name
 * @property string $message
 * @property string $chat_id
 * @property array $entities
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $vika_type_id
 * @property bool $from_tg
 * @property Carbon $created_at_date
 * @property int $count
 *
 * @property ChatIntent|null $chat_intent
 *
 * @package App\Models\Base
 */
class ChatIntentHistoryRecord extends Model
{
    protected $table = 'chat_intent_history_records';

    protected $casts = [
        'intent_id' => 'int',
        'entities' => 'json:unicode',
        'vika_type_id' => 'int',
        'from_tg' => 'bool',
        'from_max' => 'bool',
        'created_at_date'=>'date:d.m.Y',
    ];

    public function chat_intent(): BelongsTo
    {
        return $this->belongsTo(ChatIntent::class, 'intent_id');
    }

    public function vika_type(): BelongsTo
    {
        return $this->belongsTo(ChatVikaTypeAlias::class, 'vika_type_id');
    }
}
