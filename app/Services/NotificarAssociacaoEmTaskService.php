<?php

namespace App\Services;

use App\Cqrs\GetUsuariosResponsaveisTask;
use App\Cqrs\GetUsuariosResponsaveisTaskApenasId;
use App\Models\User;
use App\Notifications\AssociarUsuarioTask;
use App\Repository\TaskRepository;

class NotificarAssociacaoEmTaskService implements ContratoNotificarTasks
{
    public function execute(int $taskId)
    {

        $user = (new GetUsuariosResponsaveisTaskApenasId)->get($taskId)->toArray();
        $titulo =   (new TaskRepository)->get($taskId)->titulo;

        $users = User::whereIn('id', $user)->get();

        foreach ($users as $user) {
            $user->notify(new AssociarUsuarioTask(tasknome:$titulo, taskId: $taskId));
        }

    }
}
