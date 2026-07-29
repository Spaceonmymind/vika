<?php

namespace Modules\Chat\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\Chat\Services\Telegram\DialogFlow;

class TelegramBotController extends Controller
{
    protected DialogFlow $dialogFlow;

    public function __construct(DialogFlow $dialogFlow)
    {
        $this->dialogFlow = $dialogFlow;
        Context::add('module', 'Chat');
    }

    public function webhook(Request $request)
    {
        $data = $request->all();

        if (isset($data['message'])) {
            $chatId = $data['message']['chat']['id'];
            $text = $data['message']['text'] ?? null;
            $userInfo = [
                'first_name' => $data['message']['chat']['first_name'] ?? null,
                'last_name' => $data['message']['chat']['last_name'] ?? null,
                'username' => $data['message']['chat']['username'] ?? null,
            ];

            $this->dialogFlow->handleMessage($text, $chatId, userInfo: $userInfo);
        }

        return response()->json(['success' => true]);
    }
}





