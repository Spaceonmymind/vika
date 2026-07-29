<?php

namespace Modules\Chat\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Modules\Chat\Models\ChatMessage;

class InsertUserIdIntoRequest
{
    /**
     * Вставляет в объект запроса уникальный идентификатор чата
     *
     */
    public function handle(Request $request, Closure $next)
    {
        $request->merge([
            'chat_id' => !$request->hasCookie('chat_id') ? $this->generateChatId()->toString() : $request->cookie('chat_id'),
        ]);

        Cookie::queue(Cookie::make('chat_id', $request->chat_id, 144000, httpOnly: false, sameSite: 'None', secure: true));

        return $next($request);
    }

    /**
     * Генерирует уникальный идентификатор чата
     *
     * @return \Ramsey\Uuid\UuidInterface
     */
    private function generateChatId()
    {
        $chatId = Str::uuid();
        while (ChatMessage::query()->where('chat_id', $chatId)->exists()) {
            $chatId = Str::uuid();
        }
        return $chatId;
    }

}
