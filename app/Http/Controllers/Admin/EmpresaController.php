<?php

namespace App\Http\Controllers\Admin;

use App\Enum\PapelEnum;
use App\Http\Controllers\Controller;
use App\Models\{
    CategoriaSindicato, Contabilidade, Empresa, Endereco, Responsavel, Setor, Sindicato, User
};
use Illuminate\Http\Request;
use App\Http\Requests\CreateEmpresaFormRequest as EmpresaRequest;
use Illuminate\Support\Facades\DB;
use Throwable;

class EmpresaController extends Controller
{

    public function index()
    {
       $data = Empresa::orderBy('created_at', 'desc')->paginate(2);
       return view('admin.empresas.index',compact('data'));
    }

    public function create()
    {
        $setores = Setor::pluck('nome', 'id');
        return view('admin.empresas.create-edit',compact('setores'));
    }

    public function edit($id){
        $empresa = Empresa::find($id);
        $responsavel = $empresa->responsavel();

        return view('admin.empresas.create-edit', [
            'empresa' => $empresa,
            'endereco' => $empresa->endereco(),
            'responsavel' => $responsavel,
            'setores' => Setor::pluck('nome', 'id'),
            'setor_cadastrado' => $responsavel->setor(),
            'contabilidade' => $empresa->contabilidade()
        ]);
    }

    public function store(EmpresaRequest $request)
    {
        $result = DB::transaction(function() use ($request) {
            try {
                $endereco = new Endereco;
                $endereco->rua = $request->rua;
                $endereco->numero = $request->numero;
                $endereco->complemento = $request->complemento;
                $endereco->bairro = $request->bairro;
                $endereco->cidade = $request->cidade;
                $endereco->uf = $request->uf;
                $endereco->cep = $request->cep;
                $endereco->save();

                $user_empresa = new User;
                $user_empresa->name = $request->responsavel_nome;
                $user_empresa->email = $request->responsavel_email;
                $user_empresa->password = bcrypt($request->responsavel_password);
                $user_empresa->papel_id = PapelEnum::EMPRESA;
                $user_empresa->save();

                $responsavel_empresa = new Responsavel;
                $responsavel_empresa->nome = $request->responsavel_nome;
                $responsavel_empresa->cpf = $request->responsavel_cpf;
                $responsavel_empresa->email = $request->responsavel_email;
                $responsavel_empresa->telefone_1 = $request->responsavel_telefone_1;
                $responsavel_empresa->telefone_2 = $request->responsavel_telefone_2;
                $responsavel_empresa->setor_id = $request->responsavel_setor;
                $responsavel_empresa->save();

                if ($request->contabilidade_cnpj) {
                    $endereco_contabilidade = new Endereco;
                    $endereco_contabilidade->rua = $request->contabilidade_rua;
                    $endereco_contabilidade->numero = $request->contabilidade_numero;
                    $endereco_contabilidade->complemento = $request->contabilidade_complemento;
                    $endereco_contabilidade->bairro = $request->contabilidade_bairro;
                    $endereco_contabilidade->cidade = $request->contabilidade_cidade;
                    $endereco_contabilidade->uf = $request->contabilidade_uf;
                    $endereco_contabilidade->cep = $request->contabilidade_cep;
                    $endereco_contabilidade->save();

                    $user_contabilidade = new User;
                    $user_contabilidade->name = $request->contador_nome;
                    $user_contabilidade->email = $request->contador_email;
                    $user_contabilidade->password = bcrypt($request->contador_password);
                    $user_contabilidade->papel_id = PapelEnum::EMPRESA;
                    $user_contabilidade->save();

                    $contador = new Responsavel;
                    $contador->nome = $request->contador_nome;
                    $contador->cpf = $request->contador_cpf;
                    $contador->email = $request->contador_email;
                    $contador->telefone_1 = $request->contador_telefone_1;
                    $contador->telefone_2 = $request->contador_telefone_2;
                    $contador->setor_id = $request->contador_setor;
                    $contador->save();

                    $contabilidade = new Contabilidade;
                    $contabilidade->nome = $request->firma_contabilidade;
                    $contabilidade->cnpj = $request->contabilidade_cnpj;
                    $contabilidade->responsavel_id = $contador->id;
                    $contabilidade->endereco_id = $endereco_contabilidade->id;
                    $contabilidade->save();
                }

                $empresa = new Empresa;
                $empresa->razao_social = $request->razao_social;
                $empresa->nome_fantasia = $request->nome_fantasia;
                $empresa->cnpj = removeMaskCnpj($request->cnpj);
                $empresa->atividade_empresa = $request->atividade_empresa;
                $empresa->cnae = $request->cnae;
                $empresa->numero_funcionarios = $request->numero_funcionarios;
                $empresa->email_avisos_mensais = $request->email_para_avisos_mensais;
                $empresa->email_contabilidade = $request->email_para_contabilidade;
                $empresa->telefone_1 = $request->empresa_telefone_1;
                $empresa->telefone_2 = $request->empresa_telefone_2;
                $empresa->endereco_id = $endereco->id;
                $empresa->responsavel_id = $responsavel_empresa->id;
                if ($request->get('contabilidade_cnpj')) $empresa->contabilidade_id = $contabilidade->id;
                $empresa->save();

                $user_empresa->empresa_id = $empresa->id;
                $user_empresa->save();

                if ($request->get('contabilidade_cnpj')) {
                    $user_contabilidade->empresa_id = $empresa->id;
                    $user_contabilidade->save();
                }

                return redirect()->route('empresas.index')
                    ->with('msg', 'Empresa Cadastrada com sucesso!');
            }
            catch(Throwable $t) {
                return redirect()->route('empresas.index')
                    ->with('error', "Ocorreu um erro inesperado, tente novamente mais tarde" );
            }
        });

        return $result;
    }

    public function update(Request $request, $id)
    {
        $empresa = Empresa::find($id);

        $result = DB::transaction(function() use ($request, $empresa) {
            try {
                $endereco = $empresa->endereco();
                $endereco->rua = $request->rua;
                $endereco->numero = $request->numero;
                $endereco->complemento = $request->complemento;
                $endereco->bairro = $request->bairro;
                $endereco->cidade = $request->cidade;
                $endereco->uf = $request->uf;
                $endereco->cep = $request->cep;
                $endereco->save();

                $responsavel_empresa = $empresa->responsavel();
                $responsavel_empresa->nome = $request->responsavel_nome;
                $responsavel_empresa->cpf = $request->responsavel_cpf;
                $responsavel_empresa->telefone_1 = $request->responsavel_telefone_1;
                $responsavel_empresa->telefone_2 = $request->responsavel_telefone_2;
                $responsavel_empresa->setor_id = $request->responsavel_setor;
                $responsavel_empresa->save();

                if ($request->contabilidade_cnpj) {
                    $endereco_contabilidade = $empresa->contabilidade()->endereco();
                    $endereco_contabilidade->rua = $request->contabilidade_rua;
                    $endereco_contabilidade->numero = $request->contabilidade_numero;
                    $endereco_contabilidade->complemento = $request->contabilidade_complemento;
                    $endereco_contabilidade->bairro = $request->contabilidade_bairro;
                    $endereco_contabilidade->cidade = $request->contabilidade_cidade;
                    $endereco_contabilidade->uf = $request->contabilidade_uf;
                    $endereco_contabilidade->cep = $request->contabilidade_cep;
                    $endereco_contabilidade->save();

                    $contador = $empresa->contabilidade()->responsavel();
                    $contador->nome = $request->contador_nome;
                    $contador->cpf = $request->contador_cpf;
                    $contador->telefone_1 = $request->contador_telefone_1;
                    $contador->telefone_2 = $request->contador_telefone_2;
                    $contador->setor_id = $request->contador_setor;
                    $contador->save();

                    $contabilidade = $empresa->contabilidade();
                    $contabilidade->nome = $request->firma_contabilidade;
                    $contabilidade->cnpj = $request->contabilidade_cnpj;
                    $contabilidade->save();
                }

                $empresa->razao_social = $request->razao_social;
                $empresa->nome_fantasia = $request->nome_fantasia;
                $empresa->cnpj = removeMaskCnpj($request->cnpj);
                $empresa->atividade_empresa = $request->atividade_empresa;
                $empresa->cnae = $request->cnae;
                $empresa->numero_funcionarios = $request->numero_funcionarios;
                $empresa->email_avisos_mensais = $request->email_para_avisos_mensais;
                $empresa->email_contabilidade = $request->email_para_contabilidade;
                $empresa->telefone_1 = $request->empresa_telefone_1;
                $empresa->telefone_2 = $request->empresa_telefone_2;
                $empresa->save();

                return redirect()->route('empresas.index')
                    ->with('msg', 'Empresa atualizada com sucesso!');
            }
            catch(Throwable $t) {
                return redirect()->route('empresas.index')
                    ->with('error', "Ocorreu um erro inesperado, tente novamente mais tarde");
            }
        });

        return $result;
    }

    public function trabalhadoresListar($empresa_id)
    {
        $empresa = Empresa::find($empresa_id);

        if($empresa->categoriaSindicatos()->get()->count()) {
            return view('admin.empresas.trabalhadores.index', ['trabalhadores' => $empresa->trabalhadores(),'empresa'=> $empresa->razao_social]);
        }

        return redirect()->route('empresas.index', $empresa_id)
            ->with('error', 'Cadastre uma categoria de sindicato antes!');
    }

    public function trabalhadoresIncluir($empresa_id)
    {
        $sindicatos = Empresa::find($empresa_id)->sindicatos()->get();
        $categoria_sindicatos = Empresa::find($empresa_id)->categoriaSindicatos()->get()
            ->where('sindicato_id', $sindicatos->first()->id);

        $sindicatos = $sindicatos->pluck('cnpj', 'id');
        $categoria_sindicatos = $categoria_sindicatos->pluck('nome', 'id');

        return view('admin.empresas.trabalhadores.create-edit', [
            'categoria_sindicatos'  => $categoria_sindicatos,
            'sindicatos'            => $sindicatos
        ]);
    }

    public function sindicatosListar($empresa_id)
    {
        return view('admin.empresas.sindicatos.index', [
            'empresa'                   => Empresa::find($empresa_id)->select('razao_social')->first(),
            'sindicatos'                => Sindicato::pluck('razao_social', 'id'),
            'categoria_sindicatos'      => Sindicato::find(1)->categoriaSindicatos()->pluck('nome', 'id'),
            'categorias_cadastradas'    => Empresa::find($empresa_id)->categoriaSindicatos()->get(),
            'categoria_padrao_select'   => CategoriaSindicato::find(1)
        ]);
    }

    public function sindicatosIncluir(Request $request, $empresa_id)
    {
        $sindicato_id = $request->get('sindicato');
        $categoria_sindicato_id = $request->get('categoria_sindicatos');
        $empresa = Empresa::find($empresa_id);

        $result = DB::transaction(function() use ($sindicato_id, $categoria_sindicato_id, $empresa, $empresa_id) {
            try {

                if(!$empresa->sindicatos()->find($sindicato_id)) {
                    $empresa->sindicatos()->attach($sindicato_id);
                }

                if(!$empresa->categoriaSindicatos()->find($categoria_sindicato_id)) {
                    $empresa->categoriaSindicatos()->attach($categoria_sindicato_id);

                    return redirect()->route('empresa.sindicatos.listar', $empresa_id)
                        ->with('msg', 'Sindicato adicionado com sucesso!');
                }

                return redirect()->route('empresa.sindicatos.listar', $empresa_id)
                    ->with('error', 'Atenção! dados duplicados!');
            } catch (Throwable $t) {
                return redirect()->route('empresa.sindicatos.listar', $empresa_id)
                    ->with('error', 'Atenção! dados duplicados!');
            }
        });

        return $result;
    }
}