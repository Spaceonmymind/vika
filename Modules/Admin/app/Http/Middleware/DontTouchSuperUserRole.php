<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DontTouchSuperUserRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (($request->route('role')->id ?? null) == 1) {
            abort(404, 'No query results for model [Modules\\Admin\\Models\\Role] 1');
        }
        return $next($request);
    }
}
