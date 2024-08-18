<?php

namespace App\Cqrs;

use App\Models\Tasks;
use Illuminate\Support\Facades\DB;

class DestroyTask
{

    public function create(
        int $id,
    ): void {

        DB::transaction(function () use ($id) {
            Tasks::where('id', $id)->delete();
        });
    }
}
