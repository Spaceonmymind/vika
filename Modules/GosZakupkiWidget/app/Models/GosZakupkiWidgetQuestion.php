<?php

namespace Modules\GosZakupkiWidget\Models;

use Modules\GosZakupkiWidget\Models\Base\GosZakupkiWidgetQuestion as BaseGosZakupkiWidgetQuestion;

class GosZakupkiWidgetQuestion extends BaseGosZakupkiWidgetQuestion
{
	protected $fillable = [
		'question',
		'answer',
		'link',
		'category_id'
	];
}
