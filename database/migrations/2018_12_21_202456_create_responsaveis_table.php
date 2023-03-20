<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsaveisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsaveis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 150);
            $table->string('cpf', 30);
            $table->string('email', 100)->unique();
            $table->string('telefone_1', 50);
            $table->string('telefone_2', 50)->nullable();

            $table->unsignedInteger('setor_id');

            $table->foreign('setor_id')
                ->references('id')->on('setores')->onDelete('cascade');

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
        Schema::dropIfExists('responsaveis');
    }
}
