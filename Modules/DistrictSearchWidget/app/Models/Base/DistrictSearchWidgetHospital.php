<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\DistrictSearchWidget\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetCity;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetDistrict;

/**
 * Class DistrictSearchWidgetHospital
 *
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property string|null $site
 * @property string|null $email
 * @property string $phone
 * @property int $city_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property \Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetCity $district_search_widget_city
 * @property Collection|\Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetDistrict[] $district_search_widget_districts
 *
 * @package App\Models\Base
 */
class DistrictSearchWidgetHospital extends Model
{
	protected $table = 'district_search_widget_hospitals';

	protected $casts = [
		'city_id' => 'int',
	];


	public function district_search_widget_districts()
	{
		return $this->hasMany(DistrictSearchWidgetDistrict::class, 'hospital_id');
	}
}
