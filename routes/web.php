<?php

use App\Cqrs\GetProjects;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TasksController;
use App\Http\Middleware\AuthProject;
use Illuminate\Support\Facades\Route;

#Todo Exibir usuário associados, editar Task e projeto, deletar task e projeto,deletar associa projeto e task, noticar usuário
#Todo teste unitários subir, fila docker
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', ['projetos' => (new GetProjects)->get()]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::prefix('project')->group(function ()
    {
        Route::post('create', [ProjectsController::class, 'create'])->name('create_project');

        Route::put('update', [ProjectsController::class, 'update'])->name('update.project')
        ->middleware(AuthProject::class);

        Route::delete('delete', [ProjectsController::class, 'destroy'])->name('delete.project')
        ->middleware(AuthProject::class);

        Route::get('/{project_id}', [ProjectsController::class, 'list'])->name('page.project')
        ->middleware(AuthProject::class);

        Route::post('add/user', [ProjectsController::class, 'addUser'])->name('add.user')
        ->middleware(AuthProject::class);

    });

    Route::prefix('task')->group(function ()
    {

        Route::delete('/delete/task', [TasksController::class, 'destroy'])->name('delete.task');
        Route::post('create', [TasksController::class, 'create'])->name('create.task')
        ->middleware(AuthProject::class);
        Route::put('update/task', [TasksController::class, 'update'])->name('update.task')
;

        Route::get('/{task_id}', [TasksController::class, 'get'])->name('page.task');
        Route::get('associar/{task_id}', [TasksController::class, 'associar'])->name('page.task.associar');
        Route::post('associar', [TasksController::class, 'associarUsuarioTask'])->name('func.task.associar');

        Route::post('remover/associar', [TasksController::class, 'removerUsuarioTask'])
        ->name('func.task.romover.associar');


    });

});

require __DIR__.'/auth.php';
