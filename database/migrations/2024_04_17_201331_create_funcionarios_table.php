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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id('idFuncionario');
            $table->string('nome', 100);
            $table->string('email', 100)->unique();
            $table->string('foto', 255)->unique();
            $table->date('data_nascimento');
            $table->enum('sexo', ['masculino', 'feminino', 'indefinido']);
            $table->string('cpf', 14)->unique();
            $table->string('rg', 20)->unique();
            $table->string('endereco', 255);
            $table->string('cidade', 100);
            $table->string('estado', 50);
            $table->string('cep', 10);
            $table->string('telefone', 20);
            $table->string('cargo', 100);
            $table->decimal('salario', 10, 2);
            $table->date('data_admissao');
            $table->enum('nivel', ['1', '2', '3']);
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');
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
        Schema::dropIfExists('funcionarios');
    }
};
