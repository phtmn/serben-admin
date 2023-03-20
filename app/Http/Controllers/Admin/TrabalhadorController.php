<?php

namespace App\Http\Controllers\Admin;

use App\Enum\PapelEnum;
use App\Http\Controllers\Controller;
use App\Models\{ Endereco, User, Trabalhador };
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use App\Http\Requests\CreateTrabalhadorFormRequest as TrabalhadorRequest;

class TrabalhadorController extends Controller
{
    public function edit($id)
    {
        $trabalhador = Trabalhador::find($id);
        $empresa = $trabalhador->empresa();

        $categoria_cadastrada = $trabalhador->categoriaSindicato();
        $sindicato_cadastro = $categoria_cadastrada->sindicato();

        $sindicatos = $empresa->sindicatos()->get();
        $categoria_sindicatos = $empresa->categoriaSindicatos()->get()
            ->where('sindicato_id', $sindicato_cadastro->id);

        $sindicatos = $sindicatos->pluck('cnpj', 'id');
        $categoria_sindicatos = $categoria_sindicatos->pluck('nome', 'id');

        return view('admin.empresas.trabalhadores.create-edit', [
            'trabalhador'           => $trabalhador,
            'sindicatos'            => $sindicatos,
            'categoria_sindicatos'  => $categoria_sindicatos,
            'empresa'               => $empresa,
            'endereco'              => $trabalhador->endereco(),
            'sindicato_cadastro'    => $sindicato_cadastro,
            'categoria_cadastrada'  => $categoria_cadastrada
        ]);
    }

    public function store(TrabalhadorRequest $request)
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

                $trabalhador = new Trabalhador;
                $trabalhador->nome = $request->nome;
                $trabalhador->cpf = removeMaskCpf($request->cpf);
                $trabalhador->rg = $request->rg;
                $trabalhador->sexo = $request->sexo;
                $trabalhador->email = $request->email;
                $trabalhador->data_nascimento = $request->data_nascimento;
                $trabalhador->telefone_1 = $request->telefone_1;
                $trabalhador->telefone_2 = $request->telefone_2;
                $trabalhador->profissao = $request->profissao;

                $trabalhador->endereco_id = $endereco->id;
                $trabalhador->empresa_id = $request->empresa_id;
                $trabalhador->categoria_sindicato_id = $request->categoria_sindicatos;
                $trabalhador->save();

                $user = new User;
                $user->name = $request->nome;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->papel_id = PapelEnum::TRABALHADOR;
                $user->trabalhador_id = $trabalhador->id;
                $user->save();

                return redirect()->route('empresa.trabalhadores.listar',$request->empresa_id)
                    ->with('msg', 'Trabalhador Cadastrado com sucesso!');
            }
            catch (Throwable $t) {
                return redirect()->route('empresa.trabalhadores.incluir',$request->empresa_id)
                    ->with('error', "Ocorreu um erro inesperado, tente novamente mais tarde");
            }
        });

        return $result;
    }

    public function update(Request $request, $id)
    {
        $trabalhador = Trabalhador::find($id);

        $result = DB::transaction(function() use ($request, $trabalhador) {
            try {
                $endereco = $trabalhador->endereco();
                $endereco->rua = $request->rua;
                $endereco->numero = $request->numero;
                $endereco->complemento = $request->complemento;
                $endereco->bairro = $request->bairro;
                $endereco->cidade = $request->cidade;
                $endereco->uf = $request->uf;
                $endereco->cep = $request->cep;
                $endereco->save();

                $trabalhador->nome = $request->nome;
                $trabalhador->cpf = removeMaskCpf($request->cpf);
                $trabalhador->rg = $request->rg;
                $trabalhador->sexo = $request->sexo;
                $trabalhador->data_nascimento = $request->data_nascimento;
                $trabalhador->telefone_1 = $request->telefone_1;
                $trabalhador->telefone_2 = $request->telefone_2;
                $trabalhador->profissao = $request->profissao;
                $trabalhador->email = $request->email;

                $trabalhador->categoria_sindicato_id = $request->categoria_sindicatos;
                $trabalhador->save();

                if ($request->email and $request->password) {
                    $user = ($trabalhador->user()) ? $trabalhador->user() : new User;
                    $user->name = $request->nome;
                    $user->email = $request->email;
                    $user->password = bcrypt($request->password);
                    $user->papel_id = PapelEnum::TRABALHADOR;
                    $user->save();
                }

                return redirect()->route('empresa.trabalhadores.listar',$trabalhador->empresa()->id)
                    ->with('msg', 'Trabalhador atualizado com sucesso!');
            }
            catch (Throwable $t) {
                return redirect()->route('empresa.trabalhadores.listar',$trabalhador->empresa()->id)
//                    ->with('error', "Ocorreu um erro inesperado, tente novamente mais tarde");
                    ->with('error', $t->getMessage());
            }
        });

        return $result;
    }

    public function dependentesListar($trabalhador_id)
    {
        return view('admin.empresas.trabalhadores.dependentes.index', [
            'data' => Trabalhador::find($trabalhador_id)->dependentes()
        ]);
    }

    public function dependentesIncluir($trabalhador_id)
    {
        return view('admin.empresas.trabalhadores.dependentes.create-edit');
    }

    public function pegarEmpresa($id)
    {
        return response()->json(Trabalhador::find($id)->empresa());
    }
}