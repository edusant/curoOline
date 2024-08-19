<?php

use App\Models\Projects;
use App\Models\Tasks;
use App\Models\User;
use App\Repository\TaskRepository;

test('Criar uma task', function () {

    $user = User::factory()->create();
    $project = Projects::factory()->create([
        'user_id' => $user->id,
        'titulo' => fake()->name(),
        'descricao' => fake()->text(),
        'data_encerramento' => fake()->date()
    ]);
    $response = $this
        ->actingAs($user)
        ->post('/task/create', [
            'titulo' => fake()->name(),
            'descricao' => fake()->text(),
            'status' => 'pendente',
            'data_encerramento' => fake()->date(),
            'project_id' => $project->id,
        ]);

    $response
        ->assertSessionHasNoErrors();
});



it('get Task', function () {
    $user = User::factory()->create();

    $project = Projects::factory()->create([
        'user_id' => $user->id,
        'titulo' => fake()->name(),
        'descricao' => fake()->text(),
        'data_encerramento' => fake()->date()
    ]);

    $task = Tasks::factory()->create([
    'user_id' => $user->id,
    'titulo' => fake()->name(),
    'descricao' => fake()->text(),
    'status' => 'Pendente',
    'project_id' => $project->id,
    'data_encerramento' => fake()->date()]);
    $result =  (new TaskRepository)->get($task->id);
    $this->assertEquals($task->id, $result->id);

});
