<?php

namespace App\Cqrs;
use App\Models\Projects;

class GetProjects
{
    public function get(): object
    {
        return Projects::where('user_id', auth()->user()->id)->paginate(10);
    }
}
