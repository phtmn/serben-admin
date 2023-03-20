<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalhamentoTipoOcorrenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalhamento_tipo_ocorrencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_morte', 30)->nullable();
            $table->dateTime('data_ocorrencia')->nullable();
            $table->string('atestado_obito', 100)->nullable();
            $table->string('carta_concessao', 100)->nullable();
            $table->string('certidao_casamento_uniao_estavel', 100)->nullable();
            $table->text('informacoes_doenca')->nullable();
            $table->string('laudo_medico', 100)->nullable();
            $table->text('outro_beneficio')->nullable();

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
        Schema::dropIfExists('detalhamento_tipo_ocorrencias');
    }
}
