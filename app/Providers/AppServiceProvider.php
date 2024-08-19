<?php

namespace App\Providers;

use App\Models\Projects;
use App\Models\User;
use App\Repository\ProjectRepository;
use App\Repository\TaskRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Access\Response;
use Illuminate\Console\View\Components\Task;
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
        Gate::define('update-porject', function (User $user, $projectId) {
            return (new ProjectRepository)->get($projectId)->user_id ?? null === $user->id
                        ? Response::allow()
                        : Response::deny('');
        });

        Gate::define('update-task', function (User $user, $taskId) {
            return (new TaskRepository)->get($taskId)->user_id ?? null === $user->id
                        ? Response::allow()
                        : Response::deny('');
        });
    }
}
