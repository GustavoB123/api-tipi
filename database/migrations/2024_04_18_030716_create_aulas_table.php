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
        Schema::create('aulas', function (Blueprint $table) {
            $table->id('idAula');
            $table->string('nomeAula', 50);
            $table->string('descricaoAula', 150);
            $table->time('horarioAula');
            $table->integer('capacAlunoAula');
            $table->string('statusAula', 20);
            $table->string('fotoAula', 150);
            $table->unsignedBigInteger('idFuncionario');
            $table->foreign('idFuncionario')->references('idFuncionario')->on('funcionarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aulas');
    }
};
