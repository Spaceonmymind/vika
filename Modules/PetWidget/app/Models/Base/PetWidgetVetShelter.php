<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\PetWidget\Models\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\PetWidget\Models\PetWidgetLocality;
use Modules\PetWidget\Models\PetWidgetVetShelterAddress;
use Modules\PetWidget\Models\PetWidgetVetShelterEmail;
use Modules\PetWidget\Models\PetWidgetVetShelterPhone;

/**
 * Class PetWidgetVetShelter
 *
 * @property int $id
 * @property string $name
 * @property int $locality_id
 *
 * @property PetWidgetLocality $pet_widget_locality
 * @property Collection|PetWidgetVetShelterAddress[] $pet_widget_vet_shelter_addresses
 * @property Collection|PetWidgetVetShelterEmail[] $pet_widget_vet_shelter_emails
 * @property Collection|PetWidgetVetShelterPhone[] $pet_widget_vet_shelter_phones
 *
 * @package App\Models\Base
 */
class PetWidgetVetShelter extends Model
{
	protected $table = 'pet_widget_vet_shelters';
	public $timestamps = false;

	protected $casts = [
		'locality_id' => 'int'
	];

	public function pet_widget_locality():BelongsTo
	{
		return $this->belongsTo(PetWidgetLocality::class, 'locality_id');
	}

	public function pet_widget_vet_shelter_addresses():HasMany
	{
		return $this->hasMany(PetWidgetVetShelterAddress::class, 'shelter_id');
	}

	public function pet_widget_vet_shelter_emails():HasMany
	{
		return $this->hasMany(PetWidgetVetShelterEmail::class, 'shelter_id');
	}

	public function pet_widget_vet_shelter_phones():HasMany
	{
		return $this->hasMany(PetWidgetVetShelterPhone::class, 'shelter_id');
	}
}
