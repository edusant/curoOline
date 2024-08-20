<?php

namespace App\Cqrs;

use App\Models\ProjectUser;

class GetUsuarioEmumProjetoProProjetoId
{
    public function get(int $userId, int $projectId): object|null
    {
        return ProjectUser::where([
                'user_id' => $userId,
                'project_id' => $projectId
        ])->first();
    }
}
