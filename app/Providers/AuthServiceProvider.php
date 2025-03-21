<?php

namespace App\Providers;

use App\Auth\SanctumAuth;
use App\Auth\Authenticate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(Authenticate::class ,SanctumAuth::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
