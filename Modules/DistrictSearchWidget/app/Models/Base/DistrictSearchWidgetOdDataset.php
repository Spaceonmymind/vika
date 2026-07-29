<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\DistrictSearchWidget\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetOdDatasetType;

/**
 * Class DistrictSearchWidgetOdDataset
 *
 * @property int $id
 * @property string $url
 * @property string $data_type
 * @property string $class_handler
 * @property string|null $description
 * @property bool $need_update
 * @property bool $is_active
 * @property string|null $current_hash
 * @property int|null $dataset_type_id
 *
 * @property \Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetOdDatasetType|null $district_search_widget_od_dataset_type
 *
 * @package App\Models\Base
 */
class DistrictSearchWidgetOdDataset extends Model
{
	protected $table = 'district_search_widget_od_datasets';
	public $timestamps = false;

	protected $casts = [
		'need_update' => 'bool',
		'is_active' => 'bool',
		'dataset_type_id' => 'int',
		'last_update' => 'datetime:d.m.Y H:i:s',
	];

	public function district_search_widget_od_dataset_type()
	{
		return $this->belongsTo(DistrictSearchWidgetOdDatasetType::class, 'dataset_type_id');
	}
}
