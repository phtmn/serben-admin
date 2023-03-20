<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCobrancasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cobrancas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('empresa_id');
            $table->decimal('valor_cobranca',24,2)->default(0);
            $table->date('data_cobranca')->nullable();
            $table->string('ocorrencia')->nullable();
            $table->string('ocorrenciaTipo')->nullable();
            $table->string('ocorrenciaDescricao')->nullable();
            $table->date('data_ocorrencia')->nullable();
            $table->decimal('valor_recebido',24,2)->default(0);
            $table->decimal('valor_tarifa',24,2)->default(0);
            $table->date('data_credito')->nullable();
            $table->string('nosso_numero')->nullable();
            $table->string('numero_controle')->nullable();
            $table->boolean('remessa')->default(0);

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
        Schema::dropIfExists('cobrancas');
    }
}
