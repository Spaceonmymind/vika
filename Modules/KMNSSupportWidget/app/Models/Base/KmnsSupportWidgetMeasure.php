<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\KMNSSupportWidget\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\KMNSSupportWidget\Models\KmnsSupportWidgetLifeActivityType;

/**
 * Class KmnsSupportWidgetMeasure
 *
 * @property int $id
 * @property string $name
 * @property string|null $support_organisation
 * @property string|null $subject
 * @property string|null $terms
 * @property string|null $apply_types
 * @property string|null $get_result_types
 * @property string|null $measure_result
 * @property string|null $documents
 * @property string|null $link
 * @property int $activity_type_id
 *
 * @property KmnsSupportWidgetLifeActivityType $kmns_support_widget_life_activity_type
 *
 * @package App\Models\Base
 */
class KmnsSupportWidgetMeasure extends Model
{
	protected $table = 'kmns_support_widget_measures';
	public $timestamps = false;

	protected $casts = [
		'activity_type_id' => 'int'
	];

	public function activity_type():BelongsTo
	{
		return $this->belongsTo(KmnsSupportWidgetLifeActivityType::class, 'activity_type_id');
	}
}
