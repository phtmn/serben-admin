<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dependente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use App\Http\Requests\CreateDependenteFormRequest as DependenteRequest;

class DependenteController extends Controller
{
    public function edit($id)
    {
        return view('admin.empresas.trabalhadores.dependentes.create-edit', [
            'dependente' => Dependente::find($id)
        ]);
    }

    public function store(DependenteRequest $request)
    {
        $result = DB::transaction(function() use ($request) {
            try {
                $dependente = new Dependente;
                $dependente->nome = $request->nome;
                $dependente->cpf = removeMaskCpf($request->cpf);
                $dependente->idade = $request->idade;
                $dependente->parentesco = $request->parentesco;

                $dependente->trabalhador_id = $request->trabalhador;
                $dependente->save();

                return redirect()->route('trabalhador.dependentes.listar', $request->trabalhador)
                    ->with('msg', 'Dependente Cadastrado com sucesso!');
            }
            catch (Throwable $t) {
                return redirect()->route('trabalhador.dependentes.listar', $request->trabalhador)
                    ->with('error', "Ocorreu um erro inesperado, tente novamente mais tarde");
            }
        });

        return $result;
    }

    public function update(Request $request, $id)
    {
        $dependente = Dependente::find($id);

        $result = DB::transaction(function() use ($request, $dependente) {
            try {
                $dependente->nome = $request->nome;
                $dependente->cpf = removeMaskCpf($request->cpf);
                $dependente->idade = $request->idade;
                $dependente->parentesco = $request->parentesco;

                $dependente->save();

                return redirect()->route('trabalhador.dependentes.listar', $dependente->trabalhador()->id)
                    ->with('msg', 'Dependente Cadastrado com sucesso!');
            }
            catch (Throwable $t) {
                return redirect()->route('trabalhador.dependentes.listar', $dependente->trabalhador()->id)
                    ->with('error', "Ocorreu um erro inesperado, tente novamente mais tarde");
            }
        });

        return $result;
    }
}