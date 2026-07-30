<?php

namespace Modules\StopGraffiti\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateIntegration
{
    public function handle(Request $request, Closure $next): Response
    {
        $configuredToken = (string) config('services.stop_graffiti.integration_token');
        $providedToken = (string) $request->header(
            'X-Stop-Graffiti-Token',
            $request->bearerToken(),
        );

        if ($configuredToken === '' || $providedToken === '' || ! hash_equals($configuredToken, $providedToken)) {
            abort(Response::HTTP_UNAUTHORIZED, 'Invalid integration token.');
        }

        return $next($request);
    }
}
