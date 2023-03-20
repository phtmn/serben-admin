<?php

use Illuminate\Database\Seeder;
use App\Models\TipoOcorrencia;

class TipoOcorrenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoOcorrencia::create(['nome' => 'Falecimento']);

        TipoOcorrencia::create(['nome' => 'Incapacitação permanente para o trabalho']);

        TipoOcorrencia::create(['nome' => 'Afastamento por enfermidade']);

        TipoOcorrencia::create(['nome' => 'Afastamento por acidente']);

        TipoOcorrencia::create(['nome' => 'Nascimento filho ou doação']);

        TipoOcorrencia::create(['nome' => 'Casamento']);

        TipoOcorrencia::create(['nome' => 'outra']);
    }
}
