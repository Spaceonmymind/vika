<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\KMNSSupportWidget\Models\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\KMNSSupportWidget\Models\KmnsSupportWidgetMeasure;

/**
 * Class KmnsSupportWidgetLifeActivityType
 *
 * @property int $id
 * @property string $name
 *
 * @property Collection|\Modules\KMNSSupportWidget\Models\Base\KmnsSupportWidgetMeasure[] $kmns_support_widget_measures
 *
 * @package App\Models\Base
 */
class KmnsSupportWidgetLifeActivityType extends Model
{
	protected $table = 'kmns_support_widget_life_activity_types';
	public $timestamps = false;

	public function kmns_support_widget_measures()
	{
		return $this->hasMany(KmnsSupportWidgetMeasure::class, 'activity_type_id');
	}
}
