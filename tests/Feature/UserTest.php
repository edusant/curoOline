<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     */

    #Todo melhorar testes
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

    public function test_login(): void
    {
        $data =
        [
            'email' => fake()->email(),
            'name' => fake()->name(),
            'password' => fake()->password(),
        ];

        User::factory()->create($data);
        $response = $this->post('/api/login', $data);
        $response->assertStatus(201);

    }

    public function test_login_rate_limite(): void
    {
        $data =
        [
            'email' => fake()->email(),
            'name' => fake()->name(),
            'password' => fake()->password(),
        ];

        User::factory()->create($data);

        for ($i= 0; $i < 6; $i++)
        {
            $response = $this->post('/api/login', $data);
        }

        $response->assertStatus(401);

    }
}
