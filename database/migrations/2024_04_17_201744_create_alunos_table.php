<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id('idAluno');
            $table->string('nome', 100);
            $table->date('data_nascimento');
            $table->enum('sexo', ['masculino', 'feminino', 'indefinido']);
            $table->string('cpf', 14)->unique();
            $table->string('rg', 20)->unique();
            $table->string('endereco', 155);
            $table->string('cidade', 50);
            $table->string('cep', 10);
            $table->string('telefone', 20);
            $table->string('email', 100);
            $table->string('profissao', 100);
            $table->enum('estado_civil', ['solteiro', 'casado', 'divorciado', 'viuvo']);
            $table->decimal('altura', 5,2);
            $table->decimal('peso', 5,2);
            $table->string('tipo_sanguineo', 5);
            $table->text('alergias');
            $table->text('medicamentos_uso');
            $table->text('cirurgias_previas');
            $table->string('lesoes_previas', 255);
            $table->text('objetivo');
            $table->enum('frequencia_semanal', ['2', '3', '4', 'mais']);
            $table->time('horario_preferencial');
            $table->date('data_matricula');
            $table->enum('tipo_plano', ['basico', 'intermediario', 'completo']);
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');
            $table->string('foto', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos');
    }
};
