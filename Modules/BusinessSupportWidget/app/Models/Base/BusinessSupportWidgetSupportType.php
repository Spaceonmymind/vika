<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\BusinessSupportWidget\Models\Base;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetMeasure;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BusinessSupportWidgetSupportType
 *
 * @property int $id
 * @property string $name
 *
 * @property Collection|BusinessSupportWidgetMeasure[] $business_support_widget_measures
 *
 * @package App\Models\Base
 */
class BusinessSupportWidgetSupportType extends Model
{
	protected $table = 'business_support_widget_support_types';
	public $timestamps = false;

	public function business_support_widget_measures():HasMany
	{
		return $this->hasMany(BusinessSupportWidgetMeasure::class, 'support_type_id');
	}
}
