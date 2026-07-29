<?php

namespace Modules\PetWidget\Models;

use Modules\PetWidget\Models\Base\PetWidgetVetShelterPhone as BasePetWidgetVetShelterPhone;

class PetWidgetVetShelterPhone extends BasePetWidgetVetShelterPhone
{
	protected $fillable = [
		'phone',
		'shelter_id'
	];
}
