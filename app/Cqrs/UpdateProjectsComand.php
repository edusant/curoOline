<?php

namespace App\Cqrs;

use App\Models\Projects;
use Illuminate\Support\Facades\DB;

class UpdateProjectsComand
{

    public function create(string $titulo, string $descricao, int $id, string $dataEncerramento): void
    {
        DB::transaction(function () use ($descricao, $titulo, $dataEncerramento, $id) {
            Projects::where('id', $id)->update([
                'titulo' => $titulo,
                'descricao' => $descricao,
                'data_encerramento' => $dataEncerramento,
            ]);
        });
    }
}
