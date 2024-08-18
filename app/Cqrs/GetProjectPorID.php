<?php

namespace App\Cqrs;
use App\Models\Projects;

class GetProjectPorID
{
    public function get(int $projectId): object
    {
        return Projects::where('id', $projectId)->first();
    }
}
