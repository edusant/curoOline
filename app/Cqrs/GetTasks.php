<?php
namespace App\Cqrs;

use App\Models\Tasks;

class GetTasks
{
    public function get(int $projectId): object
    {
        return Tasks::select('titulo', 'id')->where('project_id', $projectId)->paginate(10);
    }
}
