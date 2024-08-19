<?php

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
