<?php

namespace Modules\Chat\Models;

use Modules\Chat\Models\Base\ChatMaxWebAppUrl as BaseChatMaxWebAppUrl;

class ChatMaxWebAppUrl extends BaseChatMaxWebAppUrl
{
	protected $fillable = [
		'widget_id',
		'params'
	];
}
