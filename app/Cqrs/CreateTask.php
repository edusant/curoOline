<?php

namespace App\Cqrs;

use App\Models\Tasks;
use Illuminate\Support\Facades\DB;

class CreateTask
{

    public function create(
        string $titulo,
        string $descricao,
        int $userId,
        string $dataEncerramento,
        int $projectId,
        string $status
    ): int|null {
        $id = null;
        DB::transaction(function () use (&$id, $descricao, $titulo, $dataEncerramento, $userId, $status, $projectId) {
            $id = Tasks::create([
                'titulo' => $titulo,
                'descricao' => $descricao,
                'data_encerramento' => $dataEncerramento,
                'user_id' => $userId,
                'status' => $status,
                'project_id' => $projectId
            ])->id;
        });

        return $id;
    }
}
