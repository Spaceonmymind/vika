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
 * Class BusinessSupportWidgetSubject
 *
 * @property int $id
 * @property string $name
 *
 * @property Collection|BusinessSupportWidgetMeasure[] $business_support_widget_measures
 *
 * @package App\Models\Base
 */
class BusinessSupportWidgetSubject extends Model
{
	protected $table = 'business_support_widget_subjects';
	public $timestamps = false;

	public function business_support_widget_measures():HasMany
	{
		return $this->hasMany(BusinessSupportWidgetMeasure::class, 'subject_id');
	}
}
