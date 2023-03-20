<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razao_social', 100)->nullable();
            $table->string('nome_fantasia', 100)->nullable();
            $table->string('cnpj', 30)->unique();
            $table->string('atividade_empresa', 100);
            $table->string('cnae', 50);
            $table->string('numero_funcionarios', 150)->nullable();
            $table->string('email_avisos_mensais', 100)->unique();
            $table->string('email_contabilidade', 100)->unique()->nullable();
            $table->string('telefone_1', 50);
            $table->string('telefone_2', 50)->nullable();

            $table->unsignedInteger('endereco_id');
            $table->unsignedInteger('responsavel_id');
            $table->unsignedInteger('contabilidade_id')->nullable();

            $table->foreign('endereco_id')
                ->references('id')->on('enderecos')->onDelete('cascade');
            $table->foreign('responsavel_id')
                ->references('id')->on('responsaveis')->onDelete('cascade');
            $table->foreign('contabilidade_id')
                ->references('id')->on('contabilidades')->onDelete('cascade');

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
        Schema::dropIfExists('empresas');
    }
}
