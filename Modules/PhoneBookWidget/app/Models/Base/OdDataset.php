<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\PhoneBookWidget\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OdDataset
 *
 * @property int $id
 * @property string $url
 * @property string $class_handler
 * @property Carbon|null $last_update
 * @property Carbon|null $next_update
 * @property string|null $description
 * @property bool $need_update
 * @property bool $is_active
 * @property string|null $current_hash
 *
 * @package App\Models\Base
 */
class OdDataset extends Model
{
	protected $table = 'phone_book_widget_od_datasets';
	public $timestamps = false;

	protected $casts = [
		'last_update' => 'datetime',
		'need_update' => 'bool',
		'is_active' => 'bool'
	];
}
