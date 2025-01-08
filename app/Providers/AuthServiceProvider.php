<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * The policy mappings for the application.
     *
     * @var array
     */

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::policy(\App\Models\User::class, \App\Policies\UserPolicy::class);
    }
}
