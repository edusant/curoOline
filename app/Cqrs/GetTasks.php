<?php
namespace App\Cqrs;

use App\Models\Tasks;

class GetTasks
{
    public function get(int $projectId, null|string $de, null|string $ate, null|string $status): object
    {

        $querie = Tasks::select('titulo', 'id', 'status', 'data_encerramento')->where('project_id', $projectId);

        if ($status) {
            $querie->where('status', $status);
        }

        if ($de) {
            $querie->where('data_encerramento', '>=', $de);
        }

        if ($ate) {
            $querie->where('data_encerramento', '<=', $ate);
        }

        return $querie->paginate(10);
    }
}

