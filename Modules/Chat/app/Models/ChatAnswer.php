<?php

namespace Modules\Chat\Models;

use Modules\Chat\Models\Base\ChatAnswer as BaseChatAnswer;

class ChatAnswer extends BaseChatAnswer
{
	protected $fillable = [
		'name',
		'intent_id',
        'vika_type_id',
		'is_active'
	];
}
