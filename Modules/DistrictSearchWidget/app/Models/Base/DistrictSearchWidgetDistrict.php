<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\DistrictSearchWidget\Models\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetArea;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetCity;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetDoctor;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetHospital;

/**
 * Class DistrictSearchWidgetDistrict
 *
 * @property int $id
 * @property string $number
 * @property string $type
 * @property string $address
 * @property int $hospital_id
 * @property int $city_id
 *
 * @property \Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetCity $district_search_widget_city
 * @property \Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetHospital $district_search_widget_hospital
 * @property Collection|\Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetArea[] $district_search_widget_areas
 * @property Collection|\Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetDoctor[] $district_search_widget_doctors
 *
 * @package App\Models\Base
 */
class DistrictSearchWidgetDistrict extends Model
{
	protected $table = 'district_search_widget_districts';
	public $timestamps = false;

	protected $casts = [
		'hospital_id' => 'int',
		'city_id' => 'int'
	];


	public function district_search_widget_hospital()
	{
		return $this->belongsTo(DistrictSearchWidgetHospital::class, 'hospital_id');
	}

	public function district_search_widget_areas():HasMany
	{
		return $this->hasMany(DistrictSearchWidgetArea::class, 'district_id');
	}

	public function district_search_widget_doctors():HasMany
	{
		return $this->hasMany(DistrictSearchWidgetDoctor::class, 'district_id');
	}
}
