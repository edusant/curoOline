<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
