<?php

namespace Modules\Chat\Models;

use Modules\Chat\Models\Base\ChatIntentHistoryRecord as BaseChatIntentHistoryRecord;

class ChatIntentHistoryRecord extends BaseChatIntentHistoryRecord
{
	protected $fillable = [
		'intent_id',
		'message',
		'chat_id',
		'entities',
        'vika_type_id',
        'from_tg',
        'from_max',
	];
}
