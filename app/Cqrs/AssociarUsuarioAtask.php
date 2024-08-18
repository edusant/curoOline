<?php
namespace App\Cqrs;

use App\Models\UserTask;
use Illuminate\Support\Facades\DB;

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
    }
}
