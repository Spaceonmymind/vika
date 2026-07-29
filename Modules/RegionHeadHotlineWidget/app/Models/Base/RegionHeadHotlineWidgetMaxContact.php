<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\RegionHeadHotlineWidget\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RegionHeadHotlineWidgetMaxContact
 *
 * @property int $id
 * @property int $user_id
 * @property string $phone
 * @property string|null $last_name
 * @property string|null $first_name
 * @property string|null $middle_name
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models\Base
 */
class RegionHeadHotlineWidgetMaxContact extends Model
{
	protected $table = 'region_head_hotline_widget_max_contacts';

	protected $casts = [
		'user_id' => 'int',
		'active' => 'bool'
	];
}
