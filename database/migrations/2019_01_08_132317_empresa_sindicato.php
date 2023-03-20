<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmpresaSindicato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_sindicato', function (Blueprint $table) {
            $table->unsignedInteger('empresa_id');
            $table->unsignedInteger('sindicato_id');
            $table->primary(['empresa_id', 'sindicato_id'], 'pk_empresa_sindicato');

            $table->foreign('empresa_id', 'fk_empresa_sindicato')
                ->references('id')->on('empresas')->onDelete('cascade');
            $table->foreign('sindicato_id', 'fk_sindicato_empresa')
                ->references('id')->on('sindicatos')->onDelete('cascade');
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
