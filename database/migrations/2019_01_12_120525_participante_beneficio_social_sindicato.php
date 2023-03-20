<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ParticipanteBeneficioSocialSindicato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participante_beneficio_social_sindicato', function (Blueprint $table) {
            $table->decimal('valor_beneficio_social', 24,2)->default(0);

            $table->unsignedInteger('sindicato_id');
            $table->unsignedInteger('participante_beneficio_social_id');
            $table->primary(['sindicato_id', 'participante_beneficio_social_id'], 'pk_sindicato_participante');

            $table->foreign('sindicato_id', 'fk_sindicato_participante')
                ->references('id')->on('sindicatos')->onDelete('cascade');
            $table->foreign('participante_beneficio_social_id', 'fk_participante_sindicato')
                ->references('id')->on('participante_beneficio_sociais')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participante_beneficio_social_sindicato');
    }
}
