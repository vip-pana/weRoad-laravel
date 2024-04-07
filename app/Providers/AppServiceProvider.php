<?php

namespace App\Providers;

use App\Enums\UserRole;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('isAdmin', function ($user) {
            return auth()->check() && $user->role == UserRole::ADMIN->value;
        });

        Gate::define('isEditor', function ($user) {
            return auth()->check() && $user->role == UserRole::EDITOR->value;
        });
    }
}
