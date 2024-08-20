<?php

namespace App\Providers;

use App\Cqrs\GetUsuarioEmumProjetoProProjetoId;
use App\Cqrs\GetUsuarioTaskPorIdTaskIdUsuario;
use App\Models\Projects;
use App\Models\User;
use App\Repository\ProjectRepository;
use App\Repository\TaskRepository;
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

        # Para controlar os acessos eu escolhi criar alguns gates em
        # relação a polices pois o projeto de mvp seria mais simples
        # e assim continuar aproveitando os gates "can" do blade laravel

        Gate::define('update-project', function (User $user, $projectId) {
            return (new ProjectRepository)->get($projectId)->user_id === $user->id
                        ? Response::allow()
                        : Response::deny('');
        });

        Gate::define('usuario-project', function (User $user, $projectId)
        {
            return isset((new GetUsuarioEmumProjetoProProjetoId)->get(projectId: $projectId, userId: $user->id)->id)
                        ? Response::allow()
                        : Response::deny('');
        });

        Gate::define('update-task', function (User $user, $taskId) {
            return (new TaskRepository)->get($taskId)->project->user_id === $user->id
                        ? Response::allow()
                        : Response::deny('');
        });

        Gate::define('usuario-task', function (User $user, $taskId) {
            return isset((new GetUsuarioTaskPorIdTaskIdUsuario)->get(taskId: $taskId, userId: $user->id)->id)
                        ? Response::allow()
                        : Response::deny('');
        });
    }
}
