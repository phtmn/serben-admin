<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemessasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remessas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('agencia')->nullable();
            $table->string('carteira')->nullable();
            $table->string('conta')->nullable();
            $table->string('contaDv')->nullable();
            $table->string('codigoCliente')->nullable();
            $table->date('data_processamento')->nullable();
            $table->integer('qtd_titulos')->nullable();
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
        Schema::dropIfExists('remessas');
    }
}
