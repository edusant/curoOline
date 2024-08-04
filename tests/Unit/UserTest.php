<?php

namespace Tests\Unit;

use App\Cqrs\User\CreateUser;
use App\Services\User\CriarToken;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_cadastro_login(): void
    {
        $data = [
            'email' => fake()->email(),
            'name' => fake()->name(),
            'password' => fake()->password(),
        ];

        $ret = (new CreateUser())->create($data);

        $this->assertTrue(isset($ret->id));

        $resLogin = (new CriarToken())->criaToken($data);

        $this->assertTrue(isset($resLogin->original['token']));

    }
}
