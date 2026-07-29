<?php

namespace Modules\PetWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\PetWidget\Services\VetAreaService;
use Modules\PetWidget\Swagger\Docs\Attributes\GetVetAreas;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'PetWidget', description: 'Виджеты группы "Домашние животные"')]
class VetAreaController extends Controller
{
    private VetAreaService $vetAreaService;

    /**
     * @param VetAreaService $vetAreaService
     */
    public function __construct(VetAreaService $vetAreaService)
    {
        $this->vetAreaService = $vetAreaService;
        Context::add('module', 'PetWidget');

    }

    #[GetVetAreas]
    public function getAreas(Request $request)
    {
        $validated = $request->validate([
            'locality_id' => 'sometimes',
        ]);
        return $this->vetAreaService->getAreas($validated['locality_id'] ?? null);
    }
}
