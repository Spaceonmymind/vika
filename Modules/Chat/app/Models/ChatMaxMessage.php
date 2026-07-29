<?php

namespace Modules\Chat\Models;

use Modules\Chat\Models\Base\ChatMaxMessage as BaseChatMaxMessage;

class ChatMaxMessage extends BaseChatMaxMessage
{
	protected $fillable = [
        'user_id',
		'chat_id',
		'message',
		'username',
		'last_name',
		'first_name',
		'answer'
	];
}
