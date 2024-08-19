<?php
namespace App\Cqrs;

use App\Models\User;
use App\Models\UserTask;
use App\Notifications\AssociarUsuarioTask;
use Illuminate\Support\Facades\DB;
use App\Services\NotificarAssociacaoEmTaskService;

class AssociarUsuarioAtask
{
    public function create(int $userId, int $taskId): void
    {
        DB::transaction(function () use ($userId, $taskId) {
            return UserTask::insert([
                'user_id' => $userId,
                'task_id' => $taskId
            ]);
        });

        (new NotificarAssociacaoEmTaskService)->execute(taskId: $taskId);

    }
}
