<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $primaryKey = 'idAluno';

    protected $table = 'alunos';
    protected $fillable = [
        'nome',
        'data_nascimento',
        'sexo',
        'cpf',
        'rg',
        'endereco', 
        'cidade', 
        'cep', 
        'telefone', 
        'email', 
        'profissao', 
        'estado_civil', 
        'altura', 
        'peso', 
        'tipo_sanguineo', 
        'alergias', 
        'medicamentos_uso', 
        'cirurgias_previas', 
        'lesoes_previas', 
        'objetivo', 
        'frequencia_semanal', 
        'horario_preferencial', 
        'data_matricula', 
        'tipo_plano', 
        'status', 
        'foto', 
    ];

    public function Regras(){
        return [
            'nome' => 'required|unique:alunos' . $this->idAluno . '|min:3',
            'foto' => 'required|file|mimes:jpg,jpeg,png,gif'
        ];
    }

    public function Feedback(){
        return [
            'required'      => 'O campo :attribute é obrigatório',
            // 'foto.mimes'    => 'O arquivo deve ser uma imagem em PNG ou JPG',
            'nome.unique'   => 'Esse nome já existe',
            // 'nome.min'      => 'O nome do aluno deve conter mais de 3 caracteres'
        ];
    }
}
