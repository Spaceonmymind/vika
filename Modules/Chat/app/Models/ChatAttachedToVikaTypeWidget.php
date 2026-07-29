<?php

namespace Modules\Chat\Models;

use Modules\Chat\Models\Base\ChatAttachedToVikaTypeWidget as BaseChatAttachedToVikaTypeWidget;

class ChatAttachedToVikaTypeWidget extends BaseChatAttachedToVikaTypeWidget
{
	protected $fillable = [
		'chat_widget_id',
		'vika_type_id',
		'category_id',
		'order',
        'is_favorite',
	];
}
