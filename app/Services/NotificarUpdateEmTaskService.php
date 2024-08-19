<?php

namespace App\Services;

use App\Cqrs\GetUsuariosResponsaveisTaskApenasId;
use App\Models\User;
use App\Notifications\UpdateTask;
use App\Repository\TaskRepository;

class NotificarUpdateEmTaskService implements ContratoNotificarTasks
{
    public function execute(int $taskId)
    {

        $user = (new GetUsuariosResponsaveisTaskApenasId)->get($taskId)->toArray();
        $titulo =   (new TaskRepository)->get($taskId)->titulo;

        $users = User::whereIn('id', $user)->get();

        foreach ($users as $user) {
            $user->notify(new UpdateTask(tasknome:$titulo, taskId: $taskId));
        }

    }
}
