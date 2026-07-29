<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\HumanitarianPointsWidget\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HumanitarianPointsWidgetToken
 *
 * @property int $id
 * @property string $token
 * @property Carbon $valid_to
 *
 * @package Modules\HumanitarianPointsWidget\Models\Base
 */
class HumanitarianPointsWidgetToken extends Model
{
	protected $table = 'humanitarian_points_widget_tokens';
	public $timestamps = false;

	protected $casts = [
		'valid_to' => 'datetime'
	];
}
