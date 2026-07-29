<?php

namespace Modules\Chat\Models;

use Modules\Chat\Models\Base\ChatAnswerButtonType as BaseChatAnswerButtonType;

class ChatAnswerButtonType extends BaseChatAnswerButtonType
{
	protected $fillable = [
		'code',
		'name'
	];
}
