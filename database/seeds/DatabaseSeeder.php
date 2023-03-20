<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PapeisTableSeeder::class);
        $this->call(TipoServicosTableSeeder::class);
        $this->call(StatusPagamentoTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TipoParticipanteBeneficioSociaisTableSeeder::class);
        $this->call(SetoresTableSeeder::class);
        $this->call(TipoOcorrenciasTableSeeder::class);
        $this->call(StatusOcorrenciaTableSeeder::class);
        //$this->call(SindicatosTableSeeder::class);
        //$this->call(EmpresasTableSeeder::class);
        //$this->call(TrabalhadoresTableSeeder::class);
    }
}
