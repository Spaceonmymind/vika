<?php

namespace Modules\Chat\Models;

use Modules\Chat\Models\Base\ChatVikaTypeResource as BaseChatVikaTypeResource;

class ChatVikaTypeResource extends BaseChatVikaTypeResource
{
	protected $fillable = [
		'vika_type_id',
		'resource_host'
	];
}
