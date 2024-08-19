<?php
namespace App\Repository;

use App\Models\Projects;
use Illuminate\Support\Facades\DB;

class ProjectRepository
{

    public function create(string $titulo, string $descricao, int $userId, string $dataEncerramento): void
    {
        DB::transaction(function () use ($descricao, $titulo, $dataEncerramento, $userId) {
            Projects::create([
                'titulo' => $titulo,
                'descricao' => $descricao,
                'data_encerramento' => $dataEncerramento,
                'user_id' => $userId
            ]);
        });
    }
}
