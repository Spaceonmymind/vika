<?php

namespace Modules\StopGraffiti\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            Log::warning('Rejected StopGraffiti integration request.', [
                'configured_token_length' => strlen($configuredToken),
                'provided_token_length' => strlen($providedToken),
                'custom_header_present' => $request->headers->has('X-Stop-Graffiti-Token'),
                'authorization_header_present' => $request->headers->has('Authorization'),
            ]);

            abort(Response::HTTP_UNAUTHORIZED, 'Invalid integration token.');
        }

        return $next($request);
    }
}
