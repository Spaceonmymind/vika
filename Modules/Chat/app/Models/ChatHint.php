<?php

namespace Modules\Chat\Models;

use Modules\Chat\Models\Base\ChatHint as BaseChatHint;

class ChatHint extends BaseChatHint
{
	protected $fillable = [
		'value'
	];
}
