<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DontTouchAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (($request->route('user')->id ?? null) == 1) {
            abort(404, 'No query results for model [Modules\\Admin\\Models\\User] 1');
        }
        return $next($request);
    }
}
