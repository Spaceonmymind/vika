<?php

namespace Modules\Chat\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ChatTelegramMessage
 *
 * @property int $id
 * @property string $message
 * @property int $chat_id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property int $vika_type_id
 * @property ChatVikaType $vika_type
 * @property Object $answer
 * @property string $created_at
 *
 * @package Modules\Chat\Models\Base
 */
class ChatTelegramMessage extends Model
{
    protected $table = 'chat_telegram_messages';
    public $timestamps = true;
    const UPDATED_AT = null;

    protected $fillable = [
        'message',
        'chat_id',
        'username',
        'first_name',
        'last_name',
        'vika_type_id',
        'answer',
    ];

    protected $casts = [
        'vika_type_id' => 'int',
        'answer' => 'json',
    ];

    public function vika_type(): BelongsTo
    {
        return $this->belongsTo(ChatVikaType::class, 'vika_type_id');
    }
}
