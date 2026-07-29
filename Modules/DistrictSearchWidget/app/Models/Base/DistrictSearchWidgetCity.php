<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\DistrictSearchWidget\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetArea;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetDistrict;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetHospital;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetStreet;

/**
 * Class DistrictSearchWidgetCity
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|\Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetArea[] $district_search_widget_areas
 * @property Collection|\Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetDistrict[] $district_search_widget_districts
 * @property Collection|\Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetHospital[] $district_search_widget_hospitals
 * @property Collection|DistrictSearchWidgetStreet[] $district_search_widget_streets
 *
 * @package App\Modules\DistrictSearchWidget\Models\Base
 */
class DistrictSearchWidgetCity extends Model
{
	protected $table = 'district_search_widget_cities';

	public function district_search_widget_areas()
	{
		return $this->hasMany(DistrictSearchWidgetArea::class, 'city_id');
	}

	public function district_search_widget_districts()
	{
		return $this->hasMany(DistrictSearchWidgetDistrict::class, 'city_id');
	}

	public function district_search_widget_hospitals()
	{
		return $this->hasMany(DistrictSearchWidgetHospital::class, 'city_id');
	}

	public function district_search_widget_streets():HasMany
	{
		return $this->hasMany(DistrictSearchWidgetStreet::class, 'city_id');
	}
}
