<?php

namespace Modules\EmploymentUgraWidget\Models;

use Modules\EmploymentUgraWidget\Models\Base\EmploymentUgraWidgetQuestion as BaseEmploymentUgraWidgetQuestion;

class EmploymentUgraWidgetQuestion extends BaseEmploymentUgraWidgetQuestion
{
	protected $fillable = [
		'question',
		'answer',
		'category_id'
	];
}
