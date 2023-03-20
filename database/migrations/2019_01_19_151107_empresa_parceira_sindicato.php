<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmpresaParceiraSindicato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_parceira_sindicato', function (Blueprint $table) {
            $table->decimal('valor_beneficio_social', 24,2)->default(0);

            $table->unsignedInteger('sindicato_id');
            $table->unsignedInteger('empresa_parceira_id');
            $table->primary(['sindicato_id', 'empresa_parceira_id'], 'pk_sindicato_empresa_parceira');

            $table->foreign('sindicato_id', 'fk_sindicato_empresa_parceira')
                ->references('id')->on('sindicatos')->onDelete('cascade');
            $table->foreign('empresa_parceira_id', 'fk_empresa_parceira_sindicato')
                ->references('id')->on('empresa_parceiras')->onDelete('cascade');
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
