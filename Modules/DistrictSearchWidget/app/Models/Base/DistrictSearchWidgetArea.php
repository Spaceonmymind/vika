<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\DistrictSearchWidget\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetAreaType;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetCity;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetDistrict;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetStreet;

/**
 * Class DistrictSearchWidgetArea
 *
 * @property int $id
 * @property int $district_search_widget_id
 * @property int $district_search_widget_area_type_id
 * @property int $street_id
 * @property int $city_id
 * @property int $min_house_number
 * @property int $max_house_number
 *
 * @property \Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetCity $district_search_widget_city
 * @property \Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetDistrict $district_search_widget_district
 * @property DistrictSearchWidgetStreet $district_search_widget_street
 * @property DistrictSearchWidgetAreaType $district_search_widget_area_type
 *
 * @package App\Modules\DistrictSearchWidget\Models\Base
 */
class DistrictSearchWidgetArea extends Model
{
	protected $table = 'district_search_widget_areas';
	public $timestamps = false;

	protected $casts = [
		'district_id' => 'int',
		'district_search_widget_area_type_id' => 'int',
		'street_id' => 'int',
		'city_id' => 'int',
	];

	public function district_search_widget_city()
	{
		return $this->belongsTo(DistrictSearchWidgetCity::class, 'city_id');
	}

	public function district_search_widget_district()
	{
		return $this->belongsTo(DistrictSearchWidgetDistrict::class, 'district_search_widget_id');
	}

	public function district_search_widget_street()
	{
		return $this->belongsTo(DistrictSearchWidgetStreet::class, 'street_id');
	}

	public function district_search_widget_area_type()
	{
		return $this->belongsTo(DistrictSearchWidgetAreaType::class);
	}
}
