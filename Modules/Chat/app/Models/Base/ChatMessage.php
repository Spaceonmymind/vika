<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Chat\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Chat\Models\ChatVikaType;

/**
 * Class ChatMessage
 *
 * @property int $id
 * @property string $message
 * @property string $chat_id
 * @property int $vika_type_id
 * @property ChatVikaType $vika_type
 * @property Object $answer
 * @property string $created_at
 *
 * @package Modules\Chat\Models\Base
 */
class ChatMessage extends Model
{
    protected $table = 'chat_messages';
    public $timestamps = true;
    const UPDATED_AT = null;

    protected $casts = [
        'vika_type_id' => 'int',
        'answer' => 'json:unicode',
    ];
    public function vika_type() : BelongsTo
    {
        return $this->belongsTo(ChatVikaType::class,'vika_type_id');
    }
}
