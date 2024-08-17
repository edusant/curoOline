<?php

use App\Models\User;

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
        ->assertSessionHasNoErrors()
        ->assertRedirect('/');

});


