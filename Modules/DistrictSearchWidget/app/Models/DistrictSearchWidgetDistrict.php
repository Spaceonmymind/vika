<?php

namespace Modules\DistrictSearchWidget\Models;

use Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetDistrict as BaseDistrictSearchWidgetDistrict;

class DistrictSearchWidgetDistrict extends BaseDistrictSearchWidgetDistrict
{
	protected $fillable = [
		'number',
		'type',
		'address',
		'hospital_id'
	];
}
