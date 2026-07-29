<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\RegionHeadHotlineWidget\Models\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RegionHeadHotlineWidgetAppeal
 *
 * @property int $id
 * @property int $max_user_id
 * @property int $external_id
 * @property int $appeal_number
 *
 * @package App\Models\Base
 */
class RegionHeadHotlineWidgetAppeal extends Model
{
	protected $table = 'region_head_hotline_widget_appeals';
	public $timestamps = false;

	protected $casts = [
		'max_user_id' => 'int',
		'external_id' => 'int',
		'appeal_number' => 'int'
	];
}
