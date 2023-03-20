<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipanteBeneficioSociaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participante_beneficio_sociais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logo', 100)->nullable();
            $table->string('sigla', 50)->nullable();
            $table->string('razao_social', 100)->nullable();
            $table->string('cnpj', 30)->unique();
            $table->string('numero_trabalhadores', 150)->nullable();
            $table->string('sindicatos_afiliados', 150)->nullable();
            $table->string('federacoes_afiliadas', 150)->nullable();
            $table->string('confederacoes_afiliadas', 150)->nullable();
            $table->string('empresas', 150)->nullable();
            $table->string('email', 100)->unique();
            $table->string('telefone_1', 30);
            $table->string('telefone_2', 30)->nullable();

            $table->unsignedInteger('tipo_participante_beneficio_id');
            $table->unsignedInteger('endereco_id');
            $table->unsignedInteger('presidente');
            $table->unsignedInteger('responsavel_juridico');
            $table->unsignedInteger('responsavel_acesso');
            $table->unsignedInteger('banco_id');

            $table->foreign('tipo_participante_beneficio_id', 'tipo_participante_beneficio_id')
                ->references('id')->on('tipo_participante_beneficios')->onDelete('cascade');
            $table->foreign('endereco_id')
                ->references('id')->on('enderecos')->onDelete('cascade');
            $table->foreign('presidente')
                ->references('id')->on('pessoas')->onDelete('cascade');
            $table->foreign('responsavel_juridico')
                ->references('id')->on('pessoas')->onDelete('cascade');
            $table->foreign('responsavel_acesso')
                ->references('id')->on('pessoas')->onDelete('cascade');
            $table->foreign('banco_id')
                ->references('id')->on('bancos')->onDelete('cascade');

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
        Schema::dropIfExists('participante_beneficio_sociais');
    }
}
