<?php

namespace Modules\StopGraffiti\Providers;

use Illuminate\Support\ServiceProvider;

class StopGraffitiServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path('StopGraffiti', 'database/migrations'));
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
