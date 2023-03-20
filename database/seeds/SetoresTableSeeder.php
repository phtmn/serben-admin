<?php

use Illuminate\Database\Seeder;
use App\Models\Setor;

class SetoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setor::create(['nome' => 'administrativo']);

        Setor::create(['nome' => 'beneficio']);

        Setor::create(['nome' => 'contabilidade']);

        Setor::create(['nome' => 'financeiro']);

        Setor::create(['nome' => 'recursos humanos']);
    }
}
