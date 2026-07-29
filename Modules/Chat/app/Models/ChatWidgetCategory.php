<?php

namespace Modules\Chat\Models;

use Modules\Chat\Models\Base\ChatWidgetCategory as BaseChatWidgetCategory;

class ChatWidgetCategory extends BaseChatWidgetCategory
{
	protected $fillable = [
		'name',
		'description',
		'icon_id',
		'vika_type_id',
		'order',
        'bg_colour',
        'is_favorite'
	];
}
