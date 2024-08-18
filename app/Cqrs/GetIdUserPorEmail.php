<?php
namespace App\Cqrs;

use App\Models\User;

class GetIdUserPorEmail
{
    public function get(string $email): int
    {
        return User::where('email', $email)->first()->id;
    }
}
