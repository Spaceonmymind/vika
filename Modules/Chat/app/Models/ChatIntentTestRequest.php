<?php

namespace Modules\Chat\Models;

use Modules\Chat\Models\Base\ChatIntentTestRequest as BaseChatIntentTestRequest;

class ChatIntentTestRequest extends BaseChatIntentTestRequest
{
	protected $fillable = [
		'intent_id',
		'text',
		'external_id'
	];
}
