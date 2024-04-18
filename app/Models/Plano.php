<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    use HasFactory;
protected $table = 'planos';
protected $primaryKey = 'idPlano';

public function matriculas()
{
    return $this->hasMany(Matricula::class,'idPlano');
}
}
