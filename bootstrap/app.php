<?php

use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        channels: __DIR__ . '/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api([
            AddQueuedCookiesToResponse::class,
            EnsureFrontendRequestsAreStateful::class,
        ]);

        $middleware->validateCsrfTokens(['*']);

        $middleware->trustProxies(at: '*');

        $middleware->redirectGuestsTo(function (Request $request) {
            if (str_starts_with($request->uri()->path(), 'admin')) {
                return 'admin/login';
            }
            return '/';
        });

        $middleware->redirectUsersTo(function (Request $request) {
            if ($request->uri()->path() === 'admin/login') {
                return '/admin';
            }
            return '/';
        });

        $middleware->encryptCookies([
            'chat_id',
            'permissions',
            'roles',
        ]);

        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
