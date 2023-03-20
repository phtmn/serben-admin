<?php

use Illuminate\Database\Seeder;
use App\Models\{ Endereco, User, Trabalhador, Dependente };
use App\Enum\PapelEnum;

class TrabalhadoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TRABALHADOR 1

        $endereco = new Endereco;
        $endereco->rua = 'rua 1';
        $endereco->numero = 10;
        $endereco->bairro = 'bairro 1';
        $endereco->cidade = 'cidade 1';
        $endereco->uf = 'PB';
        $endereco->cep = '58.050-126';
        $endereco->save();

        $trabalhador = new Trabalhador;
        $trabalhador->nome = 'nome 1';
        $trabalhador->cpf = '87657465821';
        $trabalhador->rg = 'rg 1';
        $trabalhador->sexo = 'M';
        $trabalhador->email = 'trabalhador1@email.com';
        $trabalhador->data_nascimento = new DateTime;
        $trabalhador->telefone_1 = 'telefone 1';
        $trabalhador->telefone_2 = 'telefone 2';
        $trabalhador->profissao = 'profissao 1';

        $trabalhador->endereco_id = $endereco->id;
        $trabalhador->empresa_id = 1;
        $trabalhador->categoria_sindicato_id = 1; // TODO - refencia a categoria 1 do sindicato 1 (pelo seed)
        $trabalhador->save();

        $user = new User();
        $user->name = 'trabalhador';
        $user->email = 'trabalhador1@email.com';
        $user->password = bcrypt('123456');
        $user->papel_id = PapelEnum::TRABALHADOR;
        $user->trabalhador_id = $trabalhador->id;
        $user->save();

        // TRABALHADOR 2

        $endereco = new Endereco;
        $endereco->rua = 'rua 2';
        $endereco->numero = 10;
        $endereco->bairro = 'bairro 2';
        $endereco->cidade = 'cidade 2';
        $endereco->uf = 'PB';
        $endereco->cep = '58.050-126';
        $endereco->save();

        $trabalhador = new Trabalhador;
        $trabalhador->nome = 'nome 2';
        $trabalhador->cpf = '76536475891';
        $trabalhador->rg = 'rg 2';
        $trabalhador->sexo = 'F';
        $trabalhador->email = 'trabalhador2@email.com';
        $trabalhador->data_nascimento = new DateTime;
        $trabalhador->telefone_1 = 'telefone 1';
        $trabalhador->telefone_2 = 'telefone 2';
        $trabalhador->profissao = 'profissao 2';

        $trabalhador->endereco_id = $endereco->id;
        $trabalhador->empresa_id = 2;
        $trabalhador->categoria_sindicato_id = 2; // TODO - refencia a categoria 1 do sindicato 1 (pelo seed)
        $trabalhador->save();

        $dependente = new Dependente;

        $dependente->nome = 'nome';
        $dependente->cpf = 'cpf';
        $dependente->idade = 10;
        $dependente->parentesco = 'parentesco';

        $dependente->trabalhador_id = $trabalhador->id;
        $dependente->save();

        $user = new User();
        $user->name = 'trabalhador 2';
        $user->email = 'trabalhador2@email.com';
        $user->password = bcrypt('123456');
        $user->papel_id = PapelEnum::SINDICATO;
        $user->trabalhador_id = $trabalhador->id;
        $user->save();
    }
}
