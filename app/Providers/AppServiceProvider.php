<?php

namespace App\Providers;

use App\Integrations\Telemost\Contracts\TelemostClient;
use App\Integrations\Telemost\StaticAccessTokenProvider;
use App\Integrations\Telemost\TelemostApiClient;
use App\Services\ExternalApi\ExternalApiHttpClient;
use App\Services\ExternalApi\Transport\LaravelHttpTransport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TelemostClient::class, static function () {
            $baseUrl = config('services.telemost.base_url');
            $token = config('services.telemost.token');

            return new TelemostApiClient(
                new ExternalApiHttpClient(
                    new LaravelHttpTransport(
                        Http::baseUrl($baseUrl)
                            ->acceptJson()
                            ->timeout(10),
                    ),
                    new StaticAccessTokenProvider($token),
                    $baseUrl,
                ),
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Model::automaticallyEagerLoadRelationships();
        Model::preventAccessingMissingAttributes();

        /** @noinspection NotOptimalIfConditionsInspection */
        /** @noinspection DevelopmentDependenciesUsageInspection */
        if ($this->app->environment('local') && class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
            /** @noinspection DevelopmentDependenciesUsageInspection */
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        if ($this->app->environment('production') || config('app.force_https', false)) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
