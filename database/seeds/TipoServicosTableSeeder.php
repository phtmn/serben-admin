<?php

use Illuminate\Database\Seeder;
use App\Models\TipoServico;

class TipoServicosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoServico::create(['nome' => 'trabalhador']);

        TipoServico::create(['nome' => 'entidade']);

        TipoServico::create(['nome' => 'empresas']);
    }
}
