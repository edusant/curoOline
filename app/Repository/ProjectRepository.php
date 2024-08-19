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

    public function update(string $titulo, string $descricao, int $id, string $dataEncerramento): void
    {
        DB::transaction(function () use ($descricao, $titulo, $dataEncerramento, $id) {
            Projects::where('id', $id)->update([
                'titulo' => $titulo,
                'descricao' => $descricao,
                'data_encerramento' => $dataEncerramento,
            ]);
        });
    }

    public function delete(int $id): void
    {
        DB::transaction(function () use ($id) {
            Projects::where('id', $id)->delete();
        });
    }

    public function get(int $projectId): object
    {
        return Projects::find($projectId);
    }


}
