<?php
namespace App\Cqrs;

use App\Models\UserTask;

class GetUsuariosResponsaveisTaskApenasId
{
    public function get(int $taskId): object
    {
        return UserTask::select( 'users.id', )
        ->join('users', 'users.id', 'user_tasks.user_id')
        ->where('user_tasks.task_id', $taskId)
        ->get();
    }



}
