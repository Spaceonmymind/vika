<?php

namespace Modules\PetWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\PetWidget\Services\VetShelterService;
use Modules\PetWidget\Swagger\Docs\Attributes\GetVetShelters;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'PetWidget', description: 'Виджеты группы "Домашние животные"')]
class VetShelterController extends Controller
{
    private VetShelterService $vetShelterService;

    /**
     * @param VetShelterService $vetShelterService
     */
    public function __construct(VetShelterService $vetShelterService)
    {
        $this->vetShelterService = $vetShelterService;
        Context::add('module', 'PetWidget');

    }

    #[GetVetShelters]
    public function getShelters(Request $request)
    {
        $validated = $request->validate([
            'locality_id' => 'sometimes',
        ]);
        return $this->vetShelterService->getShelters($validated['locality_id'] ?? null);
    }
}
