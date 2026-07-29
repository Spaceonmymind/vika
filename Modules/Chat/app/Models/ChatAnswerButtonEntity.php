<?php

namespace Modules\Chat\Models;

use Modules\Chat\Models\Base\ChatAnswerButtonEntity as BaseChatAnswerButtonEntity;

class ChatAnswerButtonEntity extends BaseChatAnswerButtonEntity
{
	protected $fillable = [
		'button_id',
		'name',
		'code',
		'param_name',
		'multiple',
		'table',
		'search_column',
		'value_column',
	];
}
