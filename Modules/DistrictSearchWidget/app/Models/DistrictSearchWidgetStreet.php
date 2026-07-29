<?php

namespace Modules\DistrictSearchWidget\Models;

use Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetStreet as BaseDistrictSearchWidgetStreet;

class DistrictSearchWidgetStreet extends BaseDistrictSearchWidgetStreet
{
	protected $fillable = [
		'name',
		'city_id'
	];
}
