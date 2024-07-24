<?php

namespace App\Cqrs\User;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\error;

class CreateUser
{
    public static function create($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => trim(strtolower($data['email'])),
            'password' => Hash::make($data['password']),
        ]);

    }
}
