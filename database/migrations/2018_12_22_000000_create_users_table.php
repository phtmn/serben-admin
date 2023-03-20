<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            $table->unsignedInteger('papel_id');
            $table->unsignedInteger('sindicato_id')->nullable();
            $table->unsignedInteger('empresa_id')->nullable();
            $table->unsignedInteger('trabalhador_id')->nullable();
            $table->unsignedInteger('empresa_parceira_id')->nullable();

            $table->foreign('papel_id')
                ->references('id')->on('papeis')->onDelete('cascade');
            $table->foreign('sindicato_id')
                ->references('id')->on('sindicatos')->onDelete('cascade');
            $table->foreign('empresa_id')
                ->references('id')->on('empresas')->onDelete('cascade');
            $table->foreign('trabalhador_id')
                ->references('id')->on('trabalhadores')->onDelete('cascade');
            $table->foreign('empresa_parceira_id')
                ->references('id')->on('empresa_parceiras')->onDelete('cascade');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
