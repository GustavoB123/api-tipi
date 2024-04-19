<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $table = "matriculas";
    protected $primaryKey = "idMatricula";

    protected $fillable = ["dataInicioMatricula","dataFimMatricula","idAluno","idPlano","statusMatricula"];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class,"idAluno");
    }

    public function plano()
    {
        return $this->belongsTo(Plano::class,"idPlano");
    }

    public function Regras(){
        return [
            'dataInicioMatricula' => 'required',
            'dataFimMatricula' => 'required',
            'idAluno' => 'required',
            'idPlano' => 'required',
            'statusMatricula' => 'in:ativo,inativo',
        ];
    }

    public function FeedBack(){
        return [
            'required' => 'O :attribute é obrigatório.'
        ];
    }
}
