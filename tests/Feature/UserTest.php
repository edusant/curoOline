<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_cadastro_usuario(): void
    {
        $data = [
            'email' => fake()->email(),
            'name' => fake()->name(),
            'password' => fake()->password(),
        ];

        $response = $this->post('/api/criar/conta', $data);
        $response->assertStatus(201);

        $response = $this->post('/api/criar/conta', $data);
        $response->assertStatus(401);
    }
}
