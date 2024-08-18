<?php

namespace App\Cqrs;

use App\Models\Projects;
use Illuminate\Support\Facades\DB;

class DeleteProjectsComand
{
    public function create(int $id): void
    {
        DB::transaction(function () use ($id) {
            Projects::where('id', $id)->delete();
        });
    }
}
