<?php

namespace App\Cqrs;

use App\Models\ProjectUser;
use Illuminate\Support\Facades\DB;

class AdicionaUsuarioEmProjeto
{
    public function create(int $userId, int $projectId): void
    {
        DB::transaction(function () use ($userId, $projectId) {
            return ProjectUser::insert([
                'user_id' => $userId,
                'project_id' => $projectId
            ]);
        });
    }
}
