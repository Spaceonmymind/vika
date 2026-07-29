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
use Modules\PetWidget\Models\PetWidgetVetClinicAddress;
use Modules\PetWidget\Models\PetWidgetVetClinicEmail;
use Modules\PetWidget\Models\PetWidgetVetClinicPhone;

/**
 * Class PetWidgetVetClinic
 *
 * @property int $id
 * @property string $name
 * @property int $locality_id
 *
 * @property PetWidgetLocality $pet_widget_locality
 * @property Collection|PetWidgetVetClinicAddress[] $pet_widget_vet_clinic_addresses
 * @property Collection|PetWidgetVetClinicEmail[] $pet_widget_vet_clinic_emails
 * @property Collection|PetWidgetVetClinicPhone[] $pet_widget_vet_clinic_phones
 *
 * @package App\Models\Base
 */
class PetWidgetVetClinic extends Model
{
	protected $table = 'pet_widget_vet_clinics';
	public $timestamps = false;

	protected $casts = [
		'locality_id' => 'int'
	];

	public function pet_widget_locality():BelongsTo
	{
		return $this->belongsTo(PetWidgetLocality::class, 'locality_id');
	}

	public function pet_widget_vet_clinic_addresses():HasMany
	{
		return $this->hasMany(PetWidgetVetClinicAddress::class, 'clinic_id');
	}

	public function pet_widget_vet_clinic_emails():HasMany
	{
		return $this->hasMany(PetWidgetVetClinicEmail::class, 'clinic_id');
	}

	public function pet_widget_vet_clinic_phones():HasMany
	{
		return $this->hasMany(PetWidgetVetClinicPhone::class, 'clinic_id');
	}
}
