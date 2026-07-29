<?php

namespace Modules\SportSectionsWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\SportSectionsWidget\Models\City;
use Modules\SportSectionsWidget\Services\SportSectionsWidgetService;
use Modules\SportSectionsWidget\Swagger\Docs\Attributes\GetCities;
use Modules\SportSectionsWidget\Swagger\Docs\Attributes\GetSportSections;
use Modules\SportSectionsWidget\Swagger\Docs\Attributes\GetSportTypes;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'SportSectionsWidget', description: 'Виджет "Спортивные секции"')]
class SportSectionsWidgetController extends Controller
{
    private SportSectionsWidgetService $sportSectionsWidgetService;

    public function __construct(SportSectionsWidgetService $sportSectionsWidgetService)
    {
        $this->sportSectionsWidgetService = $sportSectionsWidgetService;
        Context::add('module', 'SportSectionsWidget');

    }

    #[GetCities]
    public function getCities(Request $request)
    {
        return City::query()
            ->orderBy('name', 'asc')
            ->get(['id', 'name']);
    }

    #[GetSportTypes]
    public function getSportTypes(Request $request)
    {
        $validated = $request->validate([
            'city_id' => 'sometimes|exists:sport_sections_widget_cities,id',
        ]);

        return $this->sportSectionsWidgetService->getSportTypes($validated['city_id'] ?? null);
    }

    #[GetSportSections]
    public function getSections(Request $request)
    {
        $validated = $request->validate([
            'city_id' => 'sometimes|exists:sport_sections_widget_cities,id',
            'sport_id' => 'sometimes|exists:sport_sections_widget_sports,id',
            'age' => 'sometimes|nullable|integer|min:0|max:110',
        ]);

        return $this->sportSectionsWidgetService->getSections(
            $validated['city_id'] ?? null,
            $validated['sport_id'] ?? null,
            $validated['age'] ?? null);
    }
}
