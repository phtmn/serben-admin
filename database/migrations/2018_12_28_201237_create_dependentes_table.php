<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDependentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependentes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 150);
            $table->string('cpf', 30);
            $table->integer('idade');
            $table->string('parentesco', 50)->nullable();

            $table->unsignedInteger('trabalhador_id');
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
        Schema::dropIfExists('dependentes');
    }
}
