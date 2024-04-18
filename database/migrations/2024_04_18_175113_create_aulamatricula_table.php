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
        Schema::create('aulamatricula', function (Blueprint $table) {
            $table->id('idMatricula');
            $table->unsignedBigInteger('idAula');
            $table->unsignedBigInteger('idAluno');
            $table->foreign('idAula')->references('idAula')->on('aulas');
            $table->foreign('idAluno')->references('idAluno')->on('alunos');
            $table->date('dataAula');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aulamatricula');
    }
};
