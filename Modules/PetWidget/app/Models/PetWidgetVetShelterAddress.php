<?php

namespace Modules\PetWidget\Models;

use Modules\PetWidget\Models\Base\PetWidgetVetShelterAddress as BasePetWidgetVetShelterAddress;

class PetWidgetVetShelterAddress extends BasePetWidgetVetShelterAddress
{
	protected $fillable = [
		'address',
		'shelter_id'
	];
}
