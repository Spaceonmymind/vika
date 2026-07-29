<?php

namespace Modules\ITSupportWidget\Models;

use Modules\ITSupportWidget\Models\Base\ItSupportWidgetMeasure as BaseItSupportWidgetMeasure;

class ItSupportWidgetMeasure extends BaseItSupportWidgetMeasure
{
	protected $fillable = [
		'name',
		'type',
		'conditions',
		'terms',
		'responsible'
	];
}
