<?php

namespace Modules\PhoneBookWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\PhoneBookWidget\Services\PhoneBookWidgetService;
use Modules\PhoneBookWidget\Swagger\Docs\Attributes\GetPeoplesContacts;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'PhoneBookWidget', description: 'Виджет "Телефонный справочник"')]
class PhoneBookWidgetController extends Controller
{
    private PhoneBookWidgetService $bookWidgetService;

    public function __construct(PhoneBookWidgetService $bookWidgetService)
    {
        $this->bookWidgetService = $bookWidgetService;
        Context::add('module', 'PhoneBookWidget');

    }

    #[GetPeoplesContacts]
    public function getPeoplesContacts(Request $request)
    {
        $validated = $request->validate([
            'fio_or_company' => 'required|min:2',
        ]);

        return $this->bookWidgetService->getPeoplesContacts($validated['fio_or_company']);
    }
}
