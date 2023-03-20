<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOcorrenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocorrencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome_responsavel', 150);
            $table->string('departamento', 100);

            $table->unsignedInteger('tipo_ocorrencia_id');
            $table->unsignedInteger('beneficio_social_id')->nullable();
            $table->unsignedInteger('trabalhador_id');

            $table->foreign('tipo_ocorrencia_id')
                ->references('id')->on('tipo_ocorrencias')->onDelete('cascade');
            $table->foreign('beneficio_social_id')
                ->references('id')->on('beneficio_sociais')->onDelete('cascade');
            $table->foreign('trabalhador_id')
                ->references('id')->on('trabalhadores')->onDelete('cascade');

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
        Schema::dropIfExists('ocorrencias');
    }
}
