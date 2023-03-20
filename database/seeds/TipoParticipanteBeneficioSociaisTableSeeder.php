<?php

use Illuminate\Database\Seeder;
use App\Models\TipoParticipanteBeneficio;

class TipoParticipanteBeneficioSociaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoParticipanteBeneficio::create(['nome' => 'Federações']);

        TipoParticipanteBeneficio::create(['nome' => 'Confederações']);

        TipoParticipanteBeneficio::create(['nome' => 'Central Sindical']);

        TipoParticipanteBeneficio::create(['nome' => 'Entidade Patronal']);

        TipoParticipanteBeneficio::create(['nome' => 'Empresa Parceira']);
    }
}
