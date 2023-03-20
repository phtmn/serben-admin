<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoriaSindicatoEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_sindicato_empresa', function (Blueprint $table) {
            $table->unsignedInteger('empresa_id');
            $table->unsignedInteger('categoria_sindicato_id');
            $table->primary(['empresa_id', 'categoria_sindicato_id'], 'pk_empresa_categoria_sindicato');

            $table->foreign('empresa_id', 'fk_empresa_categoria')
                ->references('id')->on('empresas')->onDelete('cascade');
            $table->foreign('categoria_sindicato_id', 'fk_categoria_empresa')
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
        Schema::dropIfExists('categoria_sindicato_empresa');
    }
}
