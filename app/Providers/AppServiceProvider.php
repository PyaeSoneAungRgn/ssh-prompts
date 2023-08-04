<?php

namespace App\Providers;

use App\Services\HostService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(
            abstract: HostService::class,
            concrete: fn () => new HostService(
                path: config('app.host_path')
            )
        );
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}
