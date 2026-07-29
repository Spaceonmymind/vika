<?php

namespace Modules\Chat\Models;

use Modules\Chat\Models\Base\ChatWidgetUsageHistoryRecord as BaseChatWidgetUsageHistoryRecord;

class ChatWidgetUsageHistoryRecord extends BaseChatWidgetUsageHistoryRecord
{
	protected $fillable = [
		'chat_id',
		'from_tg',
		'from_max',
		'widget_id',
		'called_at'
	];
}
