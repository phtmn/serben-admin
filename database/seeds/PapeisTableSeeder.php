<?php

use Illuminate\Database\Seeder;
use App\Models\Papel;

class PapeisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Papel::create(['nome' => 'serben']);

        Papel::create(['nome' => 'sindicato']);

        Papel::create(['nome' => 'empresa']);

        Papel::create(['nome' => 'trabalhador']);

        Papel::create(['nome' => 'empresa parceira']);
    }
}
