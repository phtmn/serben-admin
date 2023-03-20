<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilhoTralhadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filho_tralhadores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100);
            $table->string('cpf', 20);
            $table->dateTime('data_nascimento');
            $table->string('sexo', 20);
            $table->boolean('adotivo');

            $table->unsignedInteger('ocorrencia_id');

            $table->foreign('ocorrencia_id')
                ->references('id')->on('ocorrencias')->onDelete('cascade');

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
        Schema::dropIfExists('filho_tralhadores');
    }
}
