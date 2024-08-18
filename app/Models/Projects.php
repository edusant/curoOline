<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Projects extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'data_encerramento',
        'user_id'
    ];
}
