<?php

use Illuminate\Database\Seeder;
use App\Models\{ Endereco, User, Responsavel, Contabilidade, Empresa };
use App\Enum\{ PapelEnum, SetorEnum};

class EmpresasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // EMPRESA 1 - COM CONTABILIDADE

        $endereco = new Endereco;
        $endereco->rua = 'rua';
        $endereco->numero = '10';
        $endereco->bairro = 'bairro';
        $endereco->cidade = 'cidade';
        $endereco->uf = 'PB';
        $endereco->cep = '47564576';
        $endereco->save();

        $user_empresa = new User;
        $user_empresa->name = 'responsavel empresa 1';
        $user_empresa->email = 'empresa@email.com';
        $user_empresa->password = bcrypt('123456');
        $user_empresa->papel_id = PapelEnum::EMPRESA;
        $user_empresa->save();

        $responsavel_empresa = new Responsavel;
        $responsavel_empresa->nome = 'nome do responsavel';
        $responsavel_empresa->cpf = 'cpf 1';
        $responsavel_empresa->email = 'email 1';
        $responsavel_empresa->telefone_1 = '38748374837';

        $responsavel_empresa->setor_id = SetorEnum::ADIMINISTRATIVO;
        $responsavel_empresa->save();

        $endereco_contabilidade = new Endereco;
        $endereco_contabilidade->rua = 'contabilidade rua';
        $endereco_contabilidade->numero = '10';
        $endereco_contabilidade->complemento = 'contabilidade_complemento';
        $endereco_contabilidade->bairro = 'contabilidade_bairro';
        $endereco_contabilidade->cidade = 'contabilidade_cidade';
        $endereco_contabilidade->uf = 'PB';
        $endereco_contabilidade->cep = 'contabilidade_cep';
        $endereco_contabilidade->save();

        $user_contabilidade = new User;
        $user_contabilidade->name = 'contador';
        $user_contabilidade->email = 'contador@email.com';
        $user_contabilidade->password = bcrypt('123456');
        $user_contabilidade->papel_id = PapelEnum::EMPRESA;
        $user_contabilidade->save();

        $contador = new Responsavel;
        $contador->nome = 'contador_nome';
        $contador->cpf = 'contador_cpf';
        $contador->email = 'contador@email.com';
        $contador->telefone_1 = '8374839784';
        $contador->telefone_2 = '38748378734';

        $contador->setor_id = SetorEnum::CONTABILIDADE;
        $contador->save();

        $contabilidade = new Contabilidade;
        $contabilidade->nome = 'firma_contabilidade';
        $contabilidade->cnpj = 'contabilidade_cnpj';

        $contabilidade->responsavel_id = $contador->id;
        $contabilidade->endereco_id = $endereco_contabilidade->id;
        $contabilidade->save();

        $empresa = new Empresa;
        $empresa->razao_social = 'razao_social';
        $empresa->nome_fantasia = 'nome_fantasia';
        $empresa->cnpj = 'cnpj';
        $empresa->atividade_empresa = 'atividade_empresa';
        $empresa->cnae = 'cnae';
        $empresa->numero_funcionarios = '10';
        $empresa->email_avisos_mensais = 'email_para_avisos_mensais';
        $empresa->email_contabilidade = 'email_para_contabilidade';
        $empresa->telefone_1 = '3786478364';
        $empresa->telefone_2 = '387483784';

        $empresa->endereco_id = $endereco->id;
        $empresa->responsavel_id = $responsavel_empresa->id;
        $empresa->contabilidade_id = $contabilidade->id;
        $empresa->save();

        $user_empresa->empresa_id = $empresa->id;
        $user_contabilidade->empresa_id = $empresa->id;

        $user_empresa->save();
        $user_contabilidade->save();

        // EMPRESA 2 - SEM CONTABILIDADE

        $endereco = new Endereco;
        $endereco->rua = 'rua';
        $endereco->numero = '10';
        $endereco->bairro = 'bairro';
        $endereco->cidade = 'cidade';
        $endereco->uf = 'PB';
        $endereco->cep = '47564576';
        $endereco->save();

        $user_empresa = new User;
        $user_empresa->name = 'responsavel empresa 2';
        $user_empresa->email = 'empresa2@email.com';
        $user_empresa->password = bcrypt('123456');
        $user_empresa->papel_id = PapelEnum::EMPRESA;
        $user_empresa->save();

        $responsavel_empresa = new Responsavel;
        $responsavel_empresa->nome = 'nome do responsavel';
        $responsavel_empresa->cpf = 'cpf 2';
        $responsavel_empresa->email = 'email 2';
        $responsavel_empresa->telefone_1 = '485974857';

        $responsavel_empresa->setor_id = SetorEnum::CONTABILIDADE;
        $responsavel_empresa->save();

        $empresa = new Empresa;
        $empresa->razao_social = 'razao_social 2';
        $empresa->nome_fantasia = 'nome_fantasia 2';
        $empresa->cnpj = 'cnpj2';
        $empresa->atividade_empresa = 'atividade_empresa 2';
        $empresa->cnae = 'cnae 2';
        $empresa->numero_funcionarios = '10';
        $empresa->email_avisos_mensais = 'email_para_avisos_mensais 2';
        $empresa->email_contabilidade = 'email_para_contabilidade 2';
        $empresa->telefone_1 = '487584785';
        $empresa->telefone_2 = '948598495';

        $empresa->endereco_id = $endereco->id;
        $empresa->responsavel_id = $responsavel_empresa->id;
        $empresa->save();

        $user_empresa->empresa_id = $empresa->id;
        $user_empresa->save();
    }
}
