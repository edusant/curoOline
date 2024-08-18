<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tasks extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'descricao',
        'data_encerramento',
        'user_id',
        'project_id',
        'status'
    ];


    public function project(): HasOne
    {
        return $this->hasOne(Projects::class);
    }
}
