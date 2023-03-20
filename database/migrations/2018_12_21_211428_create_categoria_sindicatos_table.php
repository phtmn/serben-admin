<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaSindicatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_sindicatos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 150);
            $table->string('cct', 100);
            $table->decimal('valor_beneficio',24,2)->default(0);

            $table->unsignedInteger('sindicato_id');

            $table->foreign('sindicato_id')
                ->references('id')->on('sindicatos')->onDelete('cascade');

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
        Schema::dropIfExists('categoria_sindicatos');
    }
}
