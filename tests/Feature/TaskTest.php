<?php

use App\Models\Projects;
use App\Models\User;

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
