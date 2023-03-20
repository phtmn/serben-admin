<?php

namespace App\Http\Controllers\Admin;

use App\Enum\PapelEnum;
use App\Http\Controllers\Controller;
use App\Models\{
    Empresa, EmpresaParceira, Endereco, Sindicato, TipoServico, User
};
use Illuminate\Http\Request;
use App\Http\Requests\CreateEmpresaParceiraFormRequest as EmpresaParceiraRequest;
use Illuminate\Support\Facades\DB;
use Throwable;

class EmpresaParceiraController extends Controller
{
    public function index()
    {
       $data = EmpresaParceira::orderBy('created_at', 'desc')->get();
       return view('admin.empresas_parceiras.index',compact('data'));
    }

    public function create()
    {
        return view('admin.empresas_parceiras.create-edit', [
            'tipo_servicos' => TipoServico::pluck('nome', 'id')
        ]);
    }

    public function edit($id)
    {
        $empresa_parceira = EmpresaParceira::find($id);

        return view('admin.empresas_parceiras.create-edit', [
            'tipo_servicos'             => TipoServico::pluck('nome', 'id'),
            'empresa_parceira'          => $empresa_parceira,
            'endereco'                  => $empresa_parceira->endereco(),
            'tipo_servico_cadastrado'   => $empresa_parceira->tipoServico()
        ]);
    }

    public function store(EmpresaParceiraRequest $request)
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

                $empresa = new EmpresaParceira;
                $empresa->razao_social = $request->razao_social;
                $empresa->nome_fantasia = $request->nome_fantasia;
                $empresa->cnpj = removeMaskCnpj($request->cnpj);
                $empresa->atividade_empresa = $request->atividade_empresa;
                $empresa->telefone = $request->telefone;

                $empresa->nome_responsavel = $request->nome_responsavel;
                $empresa->email_responsavel = $request->email_responsavel;
                $empresa->departamento_responsavel = $request->departamento_responsavel;
                $empresa->telefone_1_responsavel = $request->telefone_1_responsavel;
                $empresa->telefone_2_responsavel = $request->telefone_2_responsavel;

                $empresa->servico = $request->servico;
                $empresa->valor_vida = $request->valor_vida;
                $empresa->valor_massa = $request->valor_massa;
                $empresa->valor_evento = $request->valor_evento;

                $empresa->endereco_id = $endereco->id;
                $empresa->tipo_servico_id = $request->tipo_servico;
                $empresa->save();

                $user_empresa_parceira = new User;
                $user_empresa_parceira->name = $request->nome_responsavel;
                $user_empresa_parceira->email = $request->email_responsavel;
                $user_empresa_parceira->password = bcrypt($request->password);
                $user_empresa_parceira->papel_id = PapelEnum::EMPRESA_PARCEIRA;
                $user_empresa_parceira->empresa_parceira_id = $empresa->id;
                $user_empresa_parceira->save();

                return redirect()->route('empresa_parceiras.index')
                    ->with('msg', 'Empresa Cadastrada com sucesso!');
            }
            catch(Throwable $t) {
                return redirect()->route('empresa_parceiras.index')
                    ->with('error', "Ocorreu um erro inesperado, tente novamente mais tarde");
            }
        });

        return $result;
    }

    public function update(Request $request, $id)
    {
        $empresa_parceira = EmpresaParceira::find($id);

        $result = DB::transaction(function() use ($request, $empresa_parceira) {
            try {
                $endereco = $empresa_parceira->endereco();
                $endereco->rua = $request->rua;
                $endereco->numero = $request->numero;
                $endereco->complemento = $request->complemento;
                $endereco->bairro = $request->bairro;
                $endereco->cidade = $request->cidade;
                $endereco->uf = $request->uf;
                $endereco->cep = $request->cep;
                $endereco->save();

                $empresa_parceira->razao_social = $request->razao_social;
                $empresa_parceira->nome_fantasia = $request->nome_fantasia;
                $empresa_parceira->cnpj = removeMaskCnpj($request->cnpj);
                $empresa_parceira->atividade_empresa = $request->atividade_empresa;
                $empresa_parceira->telefone = $request->telefone;

                $empresa_parceira->nome_responsavel = $request->nome_responsavel;
                $empresa_parceira->departamento_responsavel = $request->departamento_responsavel;
                $empresa_parceira->telefone_1_responsavel = $request->telefone_1_responsavel;
                $empresa_parceira->telefone_2_responsavel = $request->telefone_2_responsavel;

                $empresa_parceira->servico = $request->servico;
                $empresa_parceira->valor_vida = $request->valor_vida;
                $empresa_parceira->valor_massa = $request->valor_massa;
                $empresa_parceira->valor_evento = $request->valor_evento;

                $empresa_parceira->tipo_servico_id = $request->tipo_servico;
                $empresa_parceira->save();

                return redirect()->route('empresa_parceiras.index')
                    ->with('msg', 'Empresa atualizada com sucesso!');
            }
            catch(Throwable $t) {
                return redirect()->route('empresa_parceiras.index')
                    ->with('error', "Ocorreu um erro inesperado, tente novamente mais tarde");
            }
        });

        return $result;
    }

    public function trabalhadoresListar($empresa_id)
    {
        $empresa = Empresa::find($empresa_id);

        if($empresa->categoriaSindicatos()->get()->count()) {
            return view('admin.empresas.trabalhadores.index', ['trabalhadores' => $empresa->trabalhadores()]);
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

        return view('admin.empresas.trabalhadores.create-edit',compact('categoria_sindicatos','sindicatos'));
    }

    public function sindicatosListar($empresa_id)
    {
        $sindicatos = Sindicato::pluck('cnpj', 'id');
        $categoria_sindicatos = Sindicato::find(1)->categoriaSindicatos()->pluck('nome', 'id');
        $categorias_cadastradas = Empresa::find($empresa_id)->categoriaSindicatos()->get();

        return view('admin.empresas.sindicatos.index', [
            'sindicatos'            => $sindicatos,
            'categoria_sindicatos'  => $categoria_sindicatos,
            'categorias_cadastradas' => $categorias_cadastradas
            ]
        );
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

    public function pegarEmpresas()
    {
        return response()->json(EmpresaParceira::all());
    }
}