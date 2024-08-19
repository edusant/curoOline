<?php

namespace App\Providers;

use App\Models\Projects;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

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
        //
        Gate::define('update-porject', function (User $user, $projectId) {
            return Projects::find($projectId)->user_id === $user->id
                        ? Response::allow()
                        : Response::deny('');
        });
    }
}
