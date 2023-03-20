<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BeneficioSocialTipoOcorrencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficio_social_tipo_ocorrencia', function (Blueprint $table) {
            $table->unsignedInteger('beneficio_social_id');
            $table->unsignedInteger('tipo_ocorrencia_id');
            $table->primary(['beneficio_social_id', 'tipo_ocorrencia_id'], 'pk_beneficio_tipo_ocorrencia');

            $table->foreign('beneficio_social_id', 'fk_beneficio_tipo_ocorrencia')
                ->references('id')->on('beneficio_sociais')->onDelete('cascade');
            $table->foreign('tipo_ocorrencia_id', 'fk_tipo_ocorrencia_beneficio')
                ->references('id')->on('tipo_ocorrencias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficio_social_tipo_ocorrencia');
    }
}
