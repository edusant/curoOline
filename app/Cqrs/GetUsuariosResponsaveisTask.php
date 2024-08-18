<?php
namespace App\Cqrs;

use App\Models\UserTask;

class GetUsuariosResponsaveisTask
{
    public function get(int $taskId): object
    {
        return UserTask::select('users.name', 'users.id', 'user_tasks.id as user_task_id')
        ->join('users', 'users.id', 'user_tasks.user_id')
        ->where('user_tasks.task_id', $taskId)
        ->get();
    }



}
