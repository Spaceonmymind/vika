<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\PetWidget\Models\Base;

use Modules\PetWidget\Models\PetWidgetVetArea;
use Modules\PetWidget\Models\PetWidgetVetClinic;
use Modules\PetWidget\Models\PetWidgetVetShelter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class PetWidgetLocality
 *
 * @property int $id
 * @property string $name
 *
 * @property Collection|PetWidgetVetArea[] $pet_widget_vet_areas
 * @property Collection|PetWidgetVetClinic[] $pet_widget_vet_clinics
 * @property Collection|PetWidgetVetShelter[] $pet_widget_vet_shelters
 *
 * @package Modules\PetWidget\Models\Base
 */
class PetWidgetLocality extends Model
{
	protected $table = 'pet_widget_localities';
	public $timestamps = false;

	public function pet_widget_vet_areas():HasMany
	{
		return $this->hasMany(PetWidgetVetArea::class, 'locality_id');
	}

	public function pet_widget_vet_clinics():HasMany
	{
		return $this->hasMany(PetWidgetVetClinic::class, 'locality_id');
	}

	public function pet_widget_vet_shelters():HasMany
	{
		return $this->hasMany(PetWidgetVetShelter::class, 'locality_id');
	}
}
