<?php
namespace App\Cqrs;

use App\Models\User;

class GetUsuariosProjetos
{
    public function get(int $projectId): object
    {
        return User::select('name', 'users.id')->where('project_user.project_id', $projectId)
        ->join('project_user', 'project_user.user_id', 'users.id')
        ->get();
    }
}
