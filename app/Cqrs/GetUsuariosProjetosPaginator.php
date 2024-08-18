<?php
namespace App\Cqrs;

use App\Models\User;
use App\Models\UserTask;

class GetUsuariosProjetosPaginator
{
    public function get(int $projectId, int $taskId): object
    {
        return User::select('name', 'users.id')->where('project_user.project_id', $projectId)
        ->join('project_user', 'project_user.user_id', 'users.id')
        ->whereNotIn('users.id', UserTask::select('users.id')
                ->join('users', 'users.id', 'user_tasks.user_id')
                ->where('user_tasks.task_id', $taskId))
        ->paginate(10);
    }
}
