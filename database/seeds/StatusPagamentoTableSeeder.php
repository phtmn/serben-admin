<?php

use Illuminate\Database\Seeder;
use App\Models\StatusPagamento;

class StatusPagamentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusPagamento::create(['nome' => 'pago']);

        StatusPagamento::create(['nome' => 'gerado']);

        StatusPagamento::create(['nome' => 'vencido']);
    }
}
