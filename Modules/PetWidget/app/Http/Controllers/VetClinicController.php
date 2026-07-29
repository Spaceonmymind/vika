<?php

namespace Modules\PetWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\PetWidget\Services\VetClinicService;
use Modules\PetWidget\Swagger\Docs\Attributes\GetVetClinics;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'PetWidget', description: 'Виджеты группы "Домашние животные"')]
class VetClinicController extends Controller
{
    private VetClinicService $vetClinicsService;

    /**
     * @param VetClinicService $vetClinicsService
     */
    public function __construct(VetClinicService $vetClinicsService)
    {
        $this->vetClinicsService = $vetClinicsService;
        Context::add('module', 'PetWidget');

    }

    #[GetVetClinics]
    public function getClinics(Request $request)
    {
        $validated = $request->validate([
            'locality_id' => 'sometimes|integer',
        ]);
        return $this->vetClinicsService->getClinics($validated['locality_id'] ?? null);
    }
}
