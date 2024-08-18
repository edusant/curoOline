<?php

use App\Cqrs\GetProjects;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', ['projetos' => (new GetProjects)->get()]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('project')->group(function ()
    {
        Route::post('create', [ProjectsController::class, 'create'])->name('create_project');
        Route::get('/{project_id}', [ProjectsController::class, 'list'])->name('page.project');
        Route::post('add/user', [ProjectsController::class, 'addUser'])->name('add.user');


    });

    Route::prefix('task')->group(function ()
    {
        Route::post('create/task', [TasksController::class, 'create'])->name('create.task');
        Route::get('/{task_id}', [TasksController::class, 'get'])->name('page.task');
        Route::get('associar/{task_id}', [TasksController::class, 'associar'])->name('page.task.associar');
        Route::post('associar', [TasksController::class, 'associarUsuarioTask'])->name('func.task.associar');

    });



});

require __DIR__.'/auth.php';
