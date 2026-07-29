<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\BusinessSupportWidget\Models\Base;

use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetMeasure;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetOdDataset;

/**
 * Class BusinessSupportWidgetMunicipality
 *
 * @property int $id
 * @property string $name
 *
 * @property Collection|BusinessSupportWidgetMeasure[] $business_support_widget_measures
 * @property Collection|\Modules\BusinessSupportWidget\Models\Base\BusinessSupportWidgetOdDataset[] $business_support_widget_od_datasets
 *
 * @package App\Models\Base
 */
class BusinessSupportWidgetMunicipality extends Model
{
	protected $table = 'business_support_widget_municipalities';
	public $timestamps = false;

	public function business_support_widget_measures():HasMany
	{
		return $this->hasMany(BusinessSupportWidgetMeasure::class, 'municipality_id');
	}

	public function business_support_widget_od_datasets()
	{
		return $this->hasMany(BusinessSupportWidgetOdDataset::class, 'municipality_id');
	}
}
