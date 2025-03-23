<?php

namespace App\Providers;

use App\Auth\SanctumAuth;
use App\Auth\SessionAuth;
use App\Auth\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Api\Auth\AuthController;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // $this->app->bind(Authenticate::class ,SanctumAuth::class);
        $this->app->when(AuthController::class)
        ->needs(Authenticate::class)
        ->give(function (Application $app) {
            if(request()->is('api/*')){
                return $app->make(SanctumAuth::class);
            }
            return $app->make(SessionAuth::class);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
