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
        Schema::create('planos', function (Blueprint $table) {
            $table->id('idPlano');
            $table->string('nomePlano', 50);
            $table->string('descricaoPlano', 150);
            $table->decimal('valorPlano', 10, 2);
            $table->enum('statusPlano', ['ativo', 'inativo'])->default('ativo');
            $table->string('fotoPlano', 150);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planos');
    }
};
