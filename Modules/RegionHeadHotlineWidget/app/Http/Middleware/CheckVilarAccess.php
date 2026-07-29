<?php

namespace Modules\RegionHeadHotlineWidget\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckVilarAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->header('X-Vilar-Access-Token') || $request->header('X-Vilar-Access-Token')!== config('services.vilar.token')) {
            return response(['error' => 'Неправильный токен доступа'], 401);
        }
        return $next($request);
    }
}
