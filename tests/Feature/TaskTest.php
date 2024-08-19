<?php

use App\Cqrs\AdicionaUsuarioEmProjeto;
use App\Models\Projects;
use App\Models\Tasks;
use App\Models\User;
use App\Repository\TaskRepository;


beforeEach(function() {
    $this->user = User::factory()->create();

    $this->project = Projects::factory()->create([
        'user_id' => $this->user->id,
        'titulo' => fake()->name(),
        'descricao' => fake()->text(),
        'data_encerramento' => fake()->date()
    ]);

    $this->task = Tasks::factory()->create([
    'user_id' => $this->user->id,
    'titulo' => fake()->name(),
    'descricao' => fake()->text(),
    'status' => 'Pendente',
    'project_id' => $this->project->id,
    'data_encerramento' => fake()->date()]);
});

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


it('atualiza um projeto existente user via resquest', function () {
    $novoTitulo = fake()->name();
    $novaDescricao = fake()->text();
    $novaDataEncerramento = fake()->date();
    $novoStatus = 'concluido';

    $user = User::factory()->create();

    $project = Projects::factory()->create([
        'user_id' => $user->id,
        'titulo' => fake()->name(),
        'descricao' => fake()->text(),
        'data_encerramento' => fake()->date()
    ]);

    $task = Tasks::factory()->create([
    'user_id' => $user->id,
    'titulo' => "novoTitulo",
    'descricao' => fake()->text(),
    'status' => 'teste',
    'project_id' => $project->id,
    'data_encerramento' => fake()->date()]);



    $response = $this
        ->actingAs($user)
        ->put('/task/update', [
            'titulo' => $novoTitulo,
            'descricao' => $novaDescricao,
            'status' => $novoStatus,
            'data_encerramento' => $novaDataEncerramento,
            'project_id' => $project->id,
            'task_id' => $task->id
        ]);

    $response
        ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'titulo' => $novoTitulo,
            'descricao' => $novaDescricao,
            'data_encerramento' => $novaDataEncerramento,
            'status' => $novoStatus,

        ]);

});


it('delete task', function () {

    $user = User::factory()->create();

    $project = Projects::factory()->create([
        'user_id' => $user->id,
        'titulo' => fake()->name(),
        'descricao' => fake()->text(),
        'data_encerramento' => fake()->date()
    ]);

    $task = Tasks::factory()->create([
    'user_id' => $user->id,
    'titulo' => "novoTitulo",
    'descricao' => fake()->text(),
    'status' => 'teste',
    'project_id' => $project->id,
    'data_encerramento' => fake()->date()]);


    $response = $this
        ->actingAs($user)
        ->delete('/task/delete', [
            'task' => $task->id,
        ]);

    $response->assertSessionHasNoErrors();

});



it('adiciona usuario a uma task', function () {

    $user = User::factory()->create();

    (new AdicionaUsuarioEmProjeto())->create($user->id, $this->project->id);

    $response = $this
    ->actingAs($user)
    ->post('/task/associar', [
        'task_id' => $this->task->id,
        'user_id' => $user->id
    ]);

    $response->assertSessionHasNoErrors();

    $this->assertDatabaseHas('user_tasks', [
        'task_id' => $this->task->id,
        'user_id' => $user->id
    ]);

});
