<?php

namespace Modules\PetWidget\Models;

use Modules\PetWidget\Models\Base\PetWidgetVetShelter as BasePetWidgetVetShelter;

class PetWidgetVetShelter extends BasePetWidgetVetShelter
{
	protected $fillable = [
		'name',
		'locality_id'
	];
}
