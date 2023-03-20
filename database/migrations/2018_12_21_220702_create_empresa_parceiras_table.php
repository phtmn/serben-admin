<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaParceirasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_parceiras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razao_social', 100)->nullable();
            $table->string('nome_fantasia', 100)->nullable();
            $table->string('cnpj', 30)->unique();
            $table->string('telefone', 50)->unique();
            $table->string('atividade_empresa', 100);
            $table->string('servico', 150);

            $table->string('nome_responsavel', 150);
            $table->string('email_responsavel', 100);
            $table->string('departamento_responsavel', 100);
            $table->string('telefone_1_responsavel', 50);
            $table->string('telefone_2_responsavel', 50)->nullable();


            $table->decimal('valor_vida', 24,2)->default(0);
            $table->decimal('valor_massa', 24,2)->default(0);
            $table->decimal('valor_evento', 24,2)->default(0);

            $table->unsignedInteger('endereco_id');
            $table->unsignedInteger('tipo_servico_id');

            $table->foreign('endereco_id')
                ->references('id')->on('enderecos')->onDelete('cascade');
            $table->foreign('tipo_servico_id')
                ->references('id')->on('tipo_servicos')->onDelete('cascade');

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
        Schema::dropIfExists('empresa_parceiras');
    }
}
