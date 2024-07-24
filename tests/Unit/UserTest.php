<?php

namespace Tests\Unit;

use App\Cqrs\User\CreateUser;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $data = [
            'email' => fake()->email(),
            'name' => fake()->name(),
            'password' => fake()->password(),
        ];
        $ret = CreateUser::create($data);
        $this->assertTrue(isset($ret->id));
    }
}
