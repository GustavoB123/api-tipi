<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'foto',
    ];

    public function Regras(){
        return [
            'nome' => 'required|unique:alunos,nome,'.$this->id.'|min:3',
            'foto' => 'required|file|mimes:jpg,jpeg,png,gif'
        ];
    }

    public function Feedback(){
        return [
            'required'      => 'O campo :attribute é obrigatório',
            'foto.mimes'    => 'O arquivo deve ser uma imagem em PNG ou JPG',
            'nome.unique'   => 'Esse nome já existe',
            'nome.min'      => 'O nome do aluno deve conter mais de 3 caracteres'
        ];
    }
}
