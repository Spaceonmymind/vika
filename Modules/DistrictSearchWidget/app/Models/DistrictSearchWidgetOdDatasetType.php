<?php

namespace Modules\DistrictSearchWidget\Models;

use Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetOdDatasetType as BaseDistrictSearchWidgetOdDatasetType;

class DistrictSearchWidgetOdDatasetType extends BaseDistrictSearchWidgetOdDatasetType
{
	protected $fillable = [
		'code',
		'name'
	];
}
