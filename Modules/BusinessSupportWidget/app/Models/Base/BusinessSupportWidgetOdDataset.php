<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\BusinessSupportWidget\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetMunicipality;

/**
 * Class BusinessSupportWidgetOdDataset
 *
 * @property int $id
 * @property string $url
 * @property string $data_type
 * @property string $class_handler
 * @property string|null $description
 * @property bool $need_update
 * @property bool $is_active
 * @property string|null $current_hash
 * @property Carbon|null $last_update
 * @property int|null $municipality_id
 *
 * @property BusinessSupportWidgetMunicipality|null $business_support_widget_municipality
 *
 * @package App\Models\Base
 */
class BusinessSupportWidgetOdDataset extends Model
{
	protected $table = 'business_support_widget_od_datasets';
	public $timestamps = false;

	protected $casts = [
		'need_update' => 'bool',
		'is_active' => 'bool',
		'last_update' => 'datetime',
		'municipality_id' => 'int'
	];

	public function business_support_widget_municipality()
	{
		return $this->belongsTo(BusinessSupportWidgetMunicipality::class, 'municipality_id');
	}
}
