<?php

namespace Modules\DistrictSearchWidget\Models;

use Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetArea as BaseDistrictSearchWidgetArea;

class DistrictSearchWidgetArea extends BaseDistrictSearchWidgetArea
{
	protected $fillable = [
		'district_id',
		'district_search_widget_area_type_id',
		'street_id',
		'city_id',
		'min_house_number',
		'max_house_number'
	];
}
