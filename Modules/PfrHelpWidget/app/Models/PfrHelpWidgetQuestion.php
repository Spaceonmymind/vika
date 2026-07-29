<?php

namespace Modules\PfrHelpWidget\Models;

use Modules\PfrHelpWidget\Models\Base\PfrHelpWidgetQuestion as BasePfrHelpWidgetQuestion;

class PfrHelpWidgetQuestion extends BasePfrHelpWidgetQuestion
{
	protected $fillable = [
		'question',
		'answer',
		'category_id'
	];
}
