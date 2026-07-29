<?php

namespace Modules\Chat\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscriptionNotificationToken
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $headerToken = $request->header('Notification-Auth-Token');
        $configToken = config('services.max.notification_token');

        if (!$headerToken || $headerToken !== $configToken) {
            return response()->json(['message' => 'Неверный токен'], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
