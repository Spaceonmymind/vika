<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\DistrictSearchWidget\Models\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetArea;

/**
 * Class DistrictSearchWidgetAreaType
 *
 * @property int $id
 * @property string $code
 * @property string $name
 *
 * @property Collection|\Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetArea[] $district_search_widget_areas
 *
 * @package App\Modules\DistrictSearchWidget\Models\Base
 */
class DistrictSearchWidgetAreaType extends Model
{
	protected $table = 'district_search_widget_area_types';
	public $timestamps = false;

	public function district_search_widget_areas()
	{
		return $this->hasMany(DistrictSearchWidgetArea::class);
	}
}
