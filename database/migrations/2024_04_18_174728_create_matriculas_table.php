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
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id('idMatricula');
            $table->datetime('dataInicioMatricula');
            $table->datetime('dataFimMatricula');
            $table->unsignedBigInteger('idAluno');
            $table->unsignedBigInteger('idPlano');
            $table->enum('statusMatricula', ['ativo', 'inativo']);
            $table->foreign('idAluno')->references('idAluno')->on('alunos');
            $table->foreign('idPlano')->references('idPlano')->on('planos');
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
        Schema::dropIfExists('matriculas');
    }
};
