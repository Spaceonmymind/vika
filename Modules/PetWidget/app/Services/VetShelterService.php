<?php

namespace Modules\PetWidget\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Modules\PetWidget\Models\PetWidgetLocality;

class VetShelterService
{
    public function getShelters($localityId = null) {
        return PetWidgetLocality::query()
            ->with([
                'pet_widget_vet_shelters',
                'pet_widget_vet_shelters.pet_widget_vet_shelter_addresses',
                'pet_widget_vet_shelters.pet_widget_vet_shelter_emails',
                'pet_widget_vet_shelters.pet_widget_vet_shelter_phones'
            ])
            ->when(isset($localityId),function (Builder $q)use ($localityId){
                $q->where('id',$localityId);
            })
            ->get();
    }
}
