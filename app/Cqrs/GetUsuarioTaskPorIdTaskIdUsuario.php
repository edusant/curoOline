<?php

namespace App\Cqrs;

use App\Models\UserTask;

class GetUsuarioTaskPorIdTaskIdUsuario
{
    public function get(int $userId, int $taskId): object|null
    {
        return UserTask::where([
                'user_id' => $userId,
                'task_id' => $taskId
        ])->first();
    }
}
