<?php
namespace App\Repository;

use App\Models\Projects;
use App\Models\Tasks;
use Illuminate\Support\Facades\DB;

class TaskRepository
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

    public function get(int $taskId): object
    {
        return Tasks::find($taskId);
    }

}
