<?php

namespace App\Cqrs;

use App\Models\Tasks;
use Illuminate\Support\Facades\DB;

class UpdateTask
{

    public function create(
        string $titulo,
        string $descricao,
        string $dataEncerramento,
        int $id,
        string $status
    ): void {

        DB::transaction(function () use ($id, $descricao, $titulo, $dataEncerramento, $status) {
            Tasks::where('id', $id)->update([
                'titulo' => $titulo,
                'descricao' => $descricao,
                'data_encerramento' => $dataEncerramento,
                'status' => $status,
            ]);
        });
    }
}
