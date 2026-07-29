<?php

namespace Modules\PfrHelpWidget\Models;

use Modules\PfrHelpWidget\Models\Base\PfrHelpWidgetQuestionCategory as BasePfrHelpWidgetQuestionCategory;

class PfrHelpWidgetQuestionCategory extends BasePfrHelpWidgetQuestionCategory
{
	protected $fillable = [
		'name',
		'service_id'
	];
}
