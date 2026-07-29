<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\DistrictSearchWidget\Models\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetOdDataset;

/**
 * Class DistrictSearchWidgetOdDatasetType
 *
 * @property int $id
 * @property string $code
 * @property string $name
 *
 * @property Collection|\Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetOdDataset[] $district_search_widget_od_datasets
 *
 * @package App\Modules\DistrictSearchWidget\Models\Base
 */
class DistrictSearchWidgetOdDatasetType extends Model
{
	protected $table = 'district_search_widget_od_dataset_types';
	public $timestamps = false;

	public function district_search_widget_od_datasets()
	{
		return $this->hasMany(DistrictSearchWidgetOdDataset::class, 'dataset_type_id');
	}
}
