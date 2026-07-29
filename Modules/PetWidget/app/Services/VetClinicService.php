<?php

namespace Modules\PetWidget\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Modules\PetWidget\Models\PetWidgetLocality;

class VetClinicService
{
    public function getClinics($localityId = null) {
        return PetWidgetLocality::query()
            ->with([
                'pet_widget_vet_clinics',
                'pet_widget_vet_clinics.pet_widget_vet_clinic_addresses',
                'pet_widget_vet_clinics.pet_widget_vet_clinic_emails',
                'pet_widget_vet_clinics.pet_widget_vet_clinic_phones'
            ])
            ->when(isset($localityId),function (Builder $q)use ($localityId){
                $q->where('id',$localityId);
            })
            ->get();
    }
}
