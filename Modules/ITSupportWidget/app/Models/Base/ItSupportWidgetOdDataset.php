<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\ITSupportWidget\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItSupportWidgetOdDataset
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
 *
 * @package App\Models\Base
 */
class ItSupportWidgetOdDataset extends Model
{
	protected $table = 'it_support_widget_od_datasets';
	public $timestamps = false;

	protected $casts = [
		'need_update' => 'bool',
		'is_active' => 'bool',
		'last_update' => 'datetime'
	];
}
