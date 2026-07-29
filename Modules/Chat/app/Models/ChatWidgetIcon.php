<?php

namespace Modules\Chat\Models;

use Modules\Chat\Models\Base\ChatWidgetIcon as BaseChatWidgetIcon;

class ChatWidgetIcon extends BaseChatWidgetIcon
{
	protected $fillable = [
		'code',
		'name'
	];
}
