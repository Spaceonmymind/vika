<?php

namespace Modules\RegionHeadHotlineWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\RegionHeadHotlineWidget\Swagger\Docs\Attributes\CreateAppeal;
use Modules\RegionHeadHotlineWidget\Swagger\Docs\Attributes\GetBadWords;
use Modules\RegionHeadHotlineWidget\Swagger\Docs\Attributes\IsUserSavedContact;
use Modules\RegionHeadHotlineWidget\Services\RegionHeadHotlineService;
use Modules\RegionHeadHotlineWidget\Swagger\Docs\Attributes\FindPeopleByMax;
use Modules\RegionHeadHotlineWidget\Swagger\Docs\Attributes\SaveMaxContact;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'RegionHeadHotlineWidget', description: 'Виджет горячая линия губернатора')]
class RegionHeadHotlineWidgetController extends Controller
{
    private RegionHeadHotlineService $regionHeadHotlineService;

    public function __construct(RegionHeadHotlineService $regionHeadHotlineService)
    {
        Context::add('module', 'RegionHeadHotlineWidget');
        $this->regionHeadHotlineService = $regionHeadHotlineService;
    }

    #[FindPeopleByMax]
    public function findPeopleByMax(Request $request)
    {
        $validated = $request->validate([
            'web_app_data' => 'required|array',
            'web_app_data.auth_date' => 'sometimes|integer|nullable',
            'web_app_data.ip' => 'sometimes|string|nullable',

            'web_app_data.chat' => 'sometimes|array',
            'web_app_data.chat.id' => 'sometimes|integer|nullable',
            'web_app_data.chat.type' => 'sometimes|string|nullable',

            'web_app_data.query_id' => 'sometimes|string',

            'web_app_data.user' => 'required|array',
            'web_app_data.user.id' => 'required|integer|nullable',
            'web_app_data.user.first_name' => 'required|string',
            'web_app_data.user.last_name' => 'sometimes|string|nullable',
            'web_app_data.user.language_code' => 'sometimes|string',
            'web_app_data.user.username' => 'sometimes|string|nullable',
            'web_app_data.user.photo_url' => 'sometimes|string|nullable',
        ]);
        return $this->regionHeadHotlineService->findPeopleByMax($validated['web_app_data']['user']['id']);
    }

    #[IsUserSavedContact]
    public function isUserSavedContact(Request $request)
    {
        $validated = $request->validate([
            'web_app_data' => 'required|array',
            'web_app_data.auth_date' => 'sometimes|integer',
            'web_app_data.ip' => 'sometimes|string|nullable',

            'web_app_data.chat' => 'sometimes|array',
            'web_app_data.chat.id' => 'sometimes|integer',
            'web_app_data.chat.type' => 'sometimes|string',

            'web_app_data.query_id' => 'sometimes|string',

            'web_app_data.user' => 'required|array',
            'web_app_data.user.id' => 'required|integer',
            'web_app_data.user.first_name' => 'required|string',
            'web_app_data.user.last_name' => 'sometimes|string|nullable',
            'web_app_data.user.language_code' => 'sometimes|string',
            'web_app_data.user.username' => 'sometimes|string|nullable',
            'web_app_data.user.photo_url' => 'sometimes|string|nullable',

        ]);

        return $this->regionHeadHotlineService->isUserSavedContact($validated['web_app_data']);
    }

    #[SaveMaxContact]
    public function saveMaxContact(Request $request)
    {
        $validated = $request->validate([
            'web_app_data' => 'required|array',
            'web_app_data.auth_date' => 'sometimes|integer',
            'web_app_data.ip' => 'sometimes|string|nullable',

            'web_app_data.chat' => 'sometimes|array',
            'web_app_data.chat.id' => 'sometimes|integer',
            'web_app_data.chat.type' => 'sometimes|string',

            'web_app_data.query_id' => 'sometimes|string',

            'web_app_data.user' => 'required|array',
            'web_app_data.user.id' => 'required|integer',
            'web_app_data.user.first_name' => 'required|string',
            'web_app_data.user.last_name' => 'sometimes|string|nullable',
            'web_app_data.user.language_code' => 'sometimes|string',
            'web_app_data.user.username' => 'sometimes|string|nullable',
            'web_app_data.user.photo_url' => 'sometimes|string|nullable',

            'phone' => 'required|string|min:10',
        ]);
        return $this->regionHeadHotlineService->saveMaxContact($validated['web_app_data'], $validated['phone']);
    }

    #[GetBadWords]
    public function getAppealBadWords(Request $request)
    {
        $validated = $request->validate([
            'complaint' => 'required|string',
        ]);
        return $this->regionHeadHotlineService->getAppealBadWords($validated['complaint']);
    }

    #[CreateAppeal]
    public function createAppeal(Request $request)
    {
        $validated = $request->validate([
            'web_app_data' => 'required|array',
            'web_app_data.auth_date' => 'sometimes|integer',
            'web_app_data.ip' => 'sometimes|string|nullable',

            'web_app_data.chat' => 'sometimes|array',
            'web_app_data.chat.id' => 'sometimes|integer',
            'web_app_data.chat.type' => 'sometimes|string',

            'web_app_data.query_id' => 'sometimes|string',

            'web_app_data.user' => 'required|array',
            'web_app_data.user.id' => 'required|integer',
            'web_app_data.user.first_name' => 'required|string',
            'web_app_data.user.last_name' => 'sometimes|string|nullable',
            'web_app_data.user.language_code' => 'sometimes|string',
            'web_app_data.user.username' => 'sometimes|string|nullable',
            'web_app_data.user.photo_url' => 'sometimes|string|nullable',

            'appeal' => 'required|array',
            'appeal.fio'=>'required|string',
            'appeal.address'=>'required|string',
            'appeal.complaint'=>'required|string|max:1000',
            'appeal.email'=>'required|email',
        ]);
        return $this->regionHeadHotlineService->createAppeal($validated['appeal'], $validated['web_app_data']);
    }
    public function sendAppealResult(Request $request)
    {
        $validated = $request->validate([
            'appeal_id'=>'required|integer',
            'response'=>'required|string',
        ]);
        return $this->regionHeadHotlineService->sendAppealResult($validated['appeal_id'], $validated['response']);
    }

}
