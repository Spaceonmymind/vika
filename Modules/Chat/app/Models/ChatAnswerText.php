<?php

namespace Modules\Chat\Models;

use Modules\Chat\Models\Base\ChatAnswerText as BaseChatAnswerText;

class ChatAnswerText extends BaseChatAnswerText
{
	protected $fillable = [
		'text',
		'answer_id'
	];
}
