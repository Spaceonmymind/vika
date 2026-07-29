<?php

namespace Modules\Chat\Models;

use Modules\Chat\Models\Base\ChatAnswerButton as BaseChatAnswerButton;

class ChatAnswerButton extends BaseChatAnswerButton
{
	protected $fillable = [
		'button_type_id',
		'name',
		'answer_id',
		'button_message_text',
		'url',
		'chat_widget_id'
	];
}
