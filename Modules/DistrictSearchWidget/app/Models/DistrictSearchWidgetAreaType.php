<?php

namespace Modules\DistrictSearchWidget\Models;

use Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetAreaType as BaseDistrictSearchWidgetAreaType;

class DistrictSearchWidgetAreaType extends BaseDistrictSearchWidgetAreaType
{
	protected $fillable = [
		'code',
		'name'
	];
}
