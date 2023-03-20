<?php

use Illuminate\Database\Seeder;
use App\Models\{ Endereco, Pessoa, Sindicato, Banco, User, CategoriaSindicato};
use App\Enum\PapelEnum;

class SindicatosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SINDICATO 1

        $endereco = new Endereco;
        $endereco->rua = 'rua 1';
        $endereco->bairro = 'bairro 1';
        $endereco->cidade = 'cidade 1';
        $endereco->uf = 'PB';
        $endereco->cep = '58.050-126';
        $endereco->save();

        $presidente = new Pessoa();
        $presidente->nome = 'presidente 1';
        $presidente->telefone_1 = '3746347634';
        $presidente->telefone_2 = '76475745763';
        $presidente->email = 'presidente1@email.com';
        $presidente->save();

        $responsavel_juridico = new Pessoa();
        $responsavel_juridico->nome = 'juridico 1';
        $responsavel_juridico->telefone_1 = '3843874834';
        $responsavel_juridico->telefone_2 = '6536456354';
        $responsavel_juridico->email = 'juridico1@gmail.com';
        $responsavel_juridico->save();

        $responsavel_acesso = new Pessoa();
        $responsavel_acesso->nome = 'reponsavel_acesso 1';
        $responsavel_acesso->telefone_1 = '3876476374';
        $responsavel_acesso->telefone_2 = '726736232938';
        $responsavel_acesso->email = 'sindicato1@email.com';
        $responsavel_acesso->save();

        $banco = new Banco;
        $banco->banco = 'banco1';
        $banco->conta = 'conta1';
        $banco->agencia = 'agencia1';
        $banco->save();

        $sindicato = new Sindicato;
        $sindicato->logo = 'logo';
        $sindicato->sigla = 'sigla';
        $sindicato->razao_social = 'razao social';
        $sindicato->cnpj = '12341234';
        $sindicato->numero_trabalhadores = '10';
        $sindicato->email = 'sindicato1@email.com';
        $sindicato->telefone_1 = '376473647';
        $sindicato->telefone_2 = '837473487384';

        $sindicato->endereco_id = $endereco->id;
        $sindicato->presidente = $presidente->id;
        $sindicato->responsavel_juridico = $responsavel_juridico->id;
        $sindicato->responsavel_acesso = $responsavel_acesso->id;
        $sindicato->banco_id = $banco->id;
        $sindicato->save();

        $categoriaSindicato = new CategoriaSindicato;
        $categoriaSindicato->nome = 'segurança';
        $categoriaSindicato->cct = 'cct1';
        $categoriaSindicato->valor_beneficio = 10;
        $categoriaSindicato->sindicato_id = $sindicato->id;
        $categoriaSindicato->save();

        $categoriaSindicato = new CategoriaSindicato;
        $categoriaSindicato->nome = 'transporte';
        $categoriaSindicato->cct = 'cct2';
        $categoriaSindicato->valor_beneficio = 20;
        $categoriaSindicato->sindicato_id = $sindicato->id;
        $categoriaSindicato->save();

        $user = new User();
        $user->name = 'reponsavel_acesso 1';
        $user->email = 'sindicato1@email.com';
        $user->password = bcrypt('123456');
        $user->papel_id = PapelEnum::SINDICATO;
        $user->sindicato_id = $sindicato->id;
        $user->save();

        // SINDICATO 2

        $endereco = new Endereco;
        $endereco->rua = 'rua 2';
        $endereco->bairro = 'bairro 2';
        $endereco->cidade = 'cidade 2';
        $endereco->uf = 'PB';
        $endereco->cep = '58.050-126';
        $endereco->save();

        $presidente = new Pessoa();
        $presidente->nome = 'presidente 2';
        $presidente->telefone_1 = '76346374637';
        $presidente->telefone_2 = '37647637434';
        $presidente->email = 'presidente2@email.com';
        $presidente->save();

        $responsavel_juridico = new Pessoa();
        $responsavel_juridico->nome = 'juridico 2';
        $responsavel_juridico->telefone_1 = '374763734';
        $responsavel_juridico->telefone_2 = '817837283';
        $responsavel_juridico->email = 'juridico2@gmail.com';
        $responsavel_juridico->save();

        $responsavel_acesso = new Pessoa();
        $responsavel_acesso->nome = 'reponsavel_acesso 2';
        $responsavel_acesso->telefone_1 = '7364763764';
        $responsavel_acesso->telefone_2 = '7364763746';
        $responsavel_acesso->email = 'sindicato2@email.com';
        $responsavel_acesso->save();

        $banco = new Banco;
        $banco->banco = 'banco2';
        $banco->conta = 'conta2';
        $banco->agencia = 'agencia2';
        $banco->save();

        $sindicato = new Sindicato;
        $sindicato->logo = 'logo';
        $sindicato->sigla = 'sigla 2';
        $sindicato->razao_social = 'razao social 2';
        $sindicato->cnpj = '65643564';
        $sindicato->numero_trabalhadores = '10';
        $sindicato->email = 'sindicato2@email.com';
        $sindicato->telefone_1 = '387487384';
        $sindicato->telefone_2 = '83748738473';

        $sindicato->endereco_id = $endereco->id;
        $sindicato->presidente = $presidente->id;
        $sindicato->responsavel_juridico = $responsavel_juridico->id;
        $sindicato->responsavel_acesso = $responsavel_acesso->id;
        $sindicato->banco_id = $banco->id;
        $sindicato->save();

        $categoriaSindicato = new CategoriaSindicato;
        $categoriaSindicato->nome = 'teste 1';
        $categoriaSindicato->cct = 'cct1';
        $categoriaSindicato->valor_beneficio = 30;
        $categoriaSindicato->sindicato_id = $sindicato->id;
        $categoriaSindicato->save();

        $categoriaSindicato = new CategoriaSindicato;
        $categoriaSindicato->nome = 'teste 2';
        $categoriaSindicato->cct = 'cct2';
        $categoriaSindicato->valor_beneficio = 40;
        $categoriaSindicato->sindicato_id = $sindicato->id;
        $categoriaSindicato->save();

        $user = new User();
        $user->name = 'reponsavel_acesso 2';
        $user->email = 'sindicato2@email.com';
        $user->password = bcrypt('123456');
        $user->papel_id = PapelEnum::SINDICATO;
        $user->sindicato_id = $sindicato->id;
        $user->save();
    }
}
