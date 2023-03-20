<?php

use Illuminate\Database\Seeder;
use App\Models\StatusOcorrencia;

class StatusOcorrenciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusOcorrencia::create(['nome' => 'aberta']);

        StatusOcorrencia::create(['nome' => 'ativa']);

        StatusOcorrencia::create(['nome' => 'aguarde de documentação']);

        StatusOcorrencia::create(['nome' => 'checagem']);

        StatusOcorrencia::create(['nome' => 'liberação para pagamento']);
    }
}
