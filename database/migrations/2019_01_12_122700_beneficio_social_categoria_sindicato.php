<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BeneficioSocialCategoriaSindicato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficio_social_categoria_sindicato', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('ehTrabalhador')->default(false);
            $table->boolean('ehConjuge')->default(false);
            $table->boolean('ehFilhosMenores')->default(false);
            $table->boolean('ehEmpresa')->default(false);
            $table->boolean('ehSindicato')->default(false);
            $table->integer('numero_parcelas');
            $table->integer('quantidade_kit');
            $table->decimal('valor', 24,2)->default(0);

            $table->unsignedInteger('beneficio_social_id');
            $table->unsignedInteger('categoria_sindicato_id');

            $table->foreign('beneficio_social_id', 'fk_beneficio_categoria')
                ->references('id')->on('beneficio_sociais')->onDelete('cascade');
            $table->foreign('categoria_sindicato_id', 'fk_categoria_beneficio')
                ->references('id')->on('categoria_sindicatos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa_sindicato');
    }
}
