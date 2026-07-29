<?php

namespace Modules\PetWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Context;
use Modules\PetWidget\Models\PetWidgetLocality;
use Modules\PetWidget\Swagger\Docs\Attributes\GetPetLocalities;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'PetWidget', description: 'Виджеты группы "Домашние животные"')]
class VetReferenceController extends Controller
{
    public function __construct() {
        Context::add('module', 'PetWidget');

    }

    #[GetPetLocalities]
    public function getLocalities()
    {
        return PetWidgetLocality::query()->orderBy('name')->get();
    }
}
