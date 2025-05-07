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
        Schema::create('funcionario', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable();
            $table->timestamp('data_exclusao')->nullable();
        });

        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('telefone');
            $table->string('telefone2')->nullable();
            $table->string('cpf')->nullable();
            $table->string('email')->nullable();
            $table->string('endereco')->nullable();
            $table->string('data');
            $table->string('tipo');
            $table->timestamp('data_exclusao')->nullable();
        });

        Schema::create('servico', function (Blueprint $table) {
            $table->increments('id_ordem');
            $table->integer('id_cliente');
            $table->longText('obs')->nullable();
            $table->string('tipo');
            $table->string('tecnico');
            $table->decimal('preco', 9, 2)->nullable();
            $table->string('situacao')->nullable();
            $table->string('data_entrada');
            $table->string('data_retirada')->nullable();
            $table->timestamp('data_exclusao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servico');
        Schema::dropIfExists('cliente');
        Schema::dropIfExists('funcionario');
    }
};
