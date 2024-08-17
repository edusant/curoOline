<?php

namespace App\Cqrs;
use App\Models\Projects;

class GetProjectPorID
{
    public function get(int $projectId): object
    {
        return Projects::select('titulo', 'id')->where('id', $projectId)->first();
    }
}
