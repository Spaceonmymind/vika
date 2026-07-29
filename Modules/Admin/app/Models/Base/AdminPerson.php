<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Admin\Models\Base;

use Modules\Admin\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminPerson
 *
 * @property int $id
 * @property string $last_name
 * @property string $first_name
 * @property string|null $middle_name
 * @property int $user_id
 *
 * @property User $user
 *
 * @package App\Models\Base
 */
class AdminPerson extends Model
{
	protected $table = 'admin_people';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
