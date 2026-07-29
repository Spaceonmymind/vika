<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\DistrictSearchWidget\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetArea;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetCity;
/**
 * Class DistrictSearchWidgetStreet
 *
 * @property int $id
 * @property string $name
 * @property int $city_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property \Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetCity $district_search_widget_city
 * @property Collection|\Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetArea[] $district_search_widget_areas
 *
 * @package App\Modules\DistrictSearchWidget\Models\Base
 */

class DistrictSearchWidgetStreet extends Model
{
	protected $table = 'district_search_widget_streets';

	protected $casts = [
		'city_id' => 'int'
	];

	public function district_search_widget_city():BelongsTo
	{
		return $this->belongsTo(DistrictSearchWidgetCity::class, 'city_id');
	}

	public function district_search_widget_areas():HasMany
	{
		return $this->hasMany(DistrictSearchWidgetArea::class, 'street_id');
	}
}
