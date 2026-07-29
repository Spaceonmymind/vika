<?php

namespace Modules\PetWidget\Models;

use Modules\PetWidget\Models\Base\PetWidgetVetClinic as BasePetWidgetVetClinic;

class PetWidgetVetClinic extends BasePetWidgetVetClinic
{
	protected $fillable = [
		'name',
		'locality_id'
	];
}
