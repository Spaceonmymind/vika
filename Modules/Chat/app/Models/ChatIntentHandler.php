<?php

namespace Modules\Chat\Models;

use Modules\Chat\Models\Base\ChatIntentHandler as BaseChatIntentHandler;

class ChatIntentHandler extends BaseChatIntentHandler
{
	protected $fillable = [
		'code',
		'name',
		'class'
	];
}
