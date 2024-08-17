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
        Route::post('create/task', [TasksController::class, 'create'])->name('create.task');
        Route::get('/{project_id}', [ProjectsController::class, 'list'])->name('page.project');

    });
});

require __DIR__.'/auth.php';
