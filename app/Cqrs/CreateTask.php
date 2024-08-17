<?php

namespace App\Cqrs;

use App\Models\Tasks;
use Illuminate\Support\Facades\DB;

class CreateTask
{

    public function create(string $titulo, string $descricao, int $userId, string $dataEncerramento,
    int $projectId, string $status): void
    {
        DB::transaction(function () use ($descricao, $titulo, $dataEncerramento, $userId, $status, $projectId) {
            Tasks::create([
                'titulo' => $titulo,
                'descricao' => $descricao,
                'data_encerramento' => $dataEncerramento,
                'user_id' => $userId,
                'status' => $status,
                'project_id' => $projectId
            ])->id;
        });
    }
}
