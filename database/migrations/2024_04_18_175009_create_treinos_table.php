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
        Schema::create('treinos', function (Blueprint $table) {
            $table->id('idTreino');
            $table->datetime('dataInicioTreino');
            $table->datetime('dataFimTreino');
            $table->unsignedBigInteger('idAluno');
            $table->unsignedBigInteger('idFuncionario');
            $table->enum('statusTreino', ['ativo', 'inativo'])->default('ativo');
            $table->foreign('idAluno')->references('idAluno')->on('alunos');
            $table->foreign('idFuncionario')->references('idFuncionario')->on('funcionarios');
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
        Schema::dropIfExists('treinos');
    }
};
