<?php

namespace Modules\Admin\Models;

use Modules\Admin\Models\Base\AdminPerson as BaseAdminPerson;

class AdminPerson extends BaseAdminPerson
{
	protected $fillable = [
		'last_name',
		'first_name',
		'middle_name',
		'user_id'
	];
}
