<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repasses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cobranca_id');
            $table->unsignedInteger('participante_id');
            $table->unsignedInteger('status_pagamento_id');
            $table->decimal('valor_repasse',24,2);
            $table->date('data_repasse');
            $table->date('data_pagamento');

            $table->foreign('status_pagamento_id')
                        ->references('id')
                        ->on('status_pagamentos')
                        ->onDelete('cascade');
            $table->foreign('cobranca_id')
                        ->references('id')
                        ->on('cobrancas')
                        ->onDelete('cascade');
            $table->foreign('participante_id')
                        ->references('id')
                        ->on('participante_beneficio_sociais')
                        ->onDelete('cascade');
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
        Schema::dropIfExists('repasses');
    }
}
