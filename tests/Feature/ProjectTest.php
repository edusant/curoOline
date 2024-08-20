<?php

use App\Models\Projects;
use App\Models\User;
use App\Repository\ProjectRepository;

test('Criar um projeto', function () {

    $user = User::factory()->create();
    $response = $this
        ->actingAs($user)
        ->post('/project/create', [
            'titulo' => fake()->name(),
            'descricao' => fake()->text(),
            'data_encerramento' => fake()->date(),
        ]);

    $response
        ->assertSessionHasNoErrors();
});

it('cria um novo projeto database', function () {
    $titulo = fake()->name;
    $descricao = fake()->text();
    $dataEncerramento = fake()->date();
    $userId = User::factory()->create()->id;
    (new ProjectRepository)->create($titulo, $descricao, $userId, $dataEncerramento);

    $this->assertDatabaseHas('projects', [
        'titulo' => $titulo,
        'descricao' => $descricao,
        'data_encerramento' => $dataEncerramento,
        'user_id' => $userId
    ]);
});




beforeEach(function() {
    $this->user = User::factory()->create();

    $this->project = Projects::factory()->create([
        'user_id' => $this->user->id,
        'titulo' => fake()->name(),
        'descricao' => fake()->text(),
        'data_encerramento' => fake()->date()
    ]);
});

it('atualiza um projeto existente', function () {
    $projectRepository = new ProjectRepository();
    $novoTitulo = fake()->name();
    $novaDescricao = fake()->text();
    $novaDataEncerramento = fake()->date();

    $projectRepository->update($novoTitulo, $novaDescricao, $this->project->id, $novaDataEncerramento);

    $this->assertDatabaseHas('projects', [
        'id' => $this->project->id,
        'titulo' => $novoTitulo,
        'descricao' => $novaDescricao,
        'data_encerramento' => $novaDataEncerramento,
    ]);

});


it('atualiza um projeto existente user via resquest', function () {
    $novoTitulo = fake()->name();
    $novaDescricao = fake()->text();
    $novaDataEncerramento = fake()->date();

    $response = $this
        ->actingAs($this->user)
        ->put('/project/update', [
            'project_id' => $this->project->id,
            'titulo' => $novoTitulo,
            'descricao' => $novaDescricao,
            'data_encerramento' => $novaDataEncerramento,
        ]);

    $response
        ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('projects', [
            'id' => $this->project->id,
            'titulo' => $novoTitulo,
            'descricao' => $novaDescricao,
            'data_encerramento' => $novaDataEncerramento,
        ]);

});


it('atualiza um projeto existente user não autorizado via resquest', function () {
    $novoTitulo = fake()->name();
    $novaDescricao = fake()->text();
    $novaDataEncerramento = fake()->date();
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->put('/project/update', [
            'project_id' => $this->project->id,
            'titulo' => $novoTitulo,
            'descricao' => $novaDescricao,
            'data_encerramento' => $novaDataEncerramento,
        ]);

    $response->assertSessionHasNoErrors()
    ->assertRedirect('/');

});


it('delete projeto', function () {


    $response = $this
        ->actingAs($this->user)
        ->delete('/project/delete', [
            'project_id' => $this->project->id,
        ]);

    $response->assertSessionHasNoErrors()
    ->assertRedirect('/dashboard');

});


it('get Projeto', function () {

    $project = Projects::factory()->create([  'user_id' => $this->user->id,
    'titulo' => fake()->name(),
    'descricao' => fake()->text(),
    'data_encerramento' => fake()->date()]);
    $result =  (new ProjectRepository)->get($project->id);
    $this->assertEquals($project->id, $result->id);

});



it('adicionar Usuario teste', function () {

    $user = User::factory()->create();

    $response = $this
        ->actingAs($this->user)
        ->post('/project/add/user', [
            'project_id' => $this->project->id,
            'email' => $user->email,
        ]);

    $response
        ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('project_user', [
            'project_id' => $this->project->id,
            'user_id' => $user->id,
        ]);
});
