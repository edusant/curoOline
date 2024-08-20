<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        return $this->hasOne(Projects::class, 'id', 'project_id');
    }

    protected function id(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) =>  $value,
        )->shouldCache();
    }

    protected function titulo(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) =>  $value,
        )->shouldCache();
    }

    protected function descricao(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) =>  $value,
        )->shouldCache();
    }

    protected function data_encerramento(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) =>  $value,
        )->shouldCache();
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) =>  $value,
        )->shouldCache();
    }

}
