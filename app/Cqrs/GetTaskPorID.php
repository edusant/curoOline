<?php

namespace App\Cqrs;
use App\Models\Tasks;

class GetTaskPorID
{
    public function get(int $taskId): object
    {
        return Tasks::where('id', $taskId)->first();
    }
}
