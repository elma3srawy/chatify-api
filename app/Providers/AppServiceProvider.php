<?php

namespace App\Providers;

use App\Models\Chat;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

define('PAGINATE', 10);

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('get-my-chat', function (User $user, Chat $chat) {
            return $user->id === $chat->receiver_id || $user->id === $chat->sender_id;
        });
    }
}
