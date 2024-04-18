<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrutor extends Model
{
    use HasFactory;

    protected $table = "instrutores";

    protected $fillable = [
        'nome',
        'foto',
        'email',
    ];

    public function Regras(){
        return [
            'nome'   => 'required|unique:instrutores,nome,'.$this->id.'|min:3',
            'foto'   => 'required|file|mimes:jpg,png',
            'email'  => 'required|email',
        ];
    }

    public function Feedback(){
        return [
            'required'      => 'O campo :attribute é obrigatório',
            'foto.mimes'    => 'O arquivo deve ser uma imagem em PNG ou JPG',
            'nome.unique'   => 'Esse nome já existe',
            'nome.min'      => 'O nome do aluno deve conter mais de 3 caracteres',
            'email'         => 'Informe um email válido',
        ];
    }
}
