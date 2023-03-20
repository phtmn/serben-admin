<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{ BeneficioSocial, TipoOcorrencia };
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateBeneficioSocialFormRequest as BeneficioSocialRequest;
use Throwable;

class BeneficioSocialController extends Controller
{

    public function index()
    {
        return view('admin.beneficios_sociais.index', [
            'data' => BeneficioSocial::orderBy('created_at', 'desc')->get()
        ]);
    }

    public function create()
    {
        return view('admin.beneficios_sociais.create-edit', [
            'tipo_ocorrencias' => TipoOcorrencia::pluck('nome', 'id')
        ]);
    }

    public function edit($id)
    {
        $beneficio = BeneficioSocial::find($id);

        return view('admin.beneficios_sociais.create-edit', [
            'tipo_ocorrencias' => TipoOcorrencia::pluck('nome', 'id'),
            'beneficio' => $beneficio
        ]);
    }

    public function store(BeneficioSocialRequest $request)
    {
        $result = DB::transaction(function() use ($request) {
           try {
               $beneficioSocial = new BeneficioSocial();
               $beneficioSocial->nome = $request->nome;
               $beneficioSocial->item = $request->item;
               $beneficioSocial->descricao = $request->descricao;
               $beneficioSocial->descricao_privada = $request->descricao_privada;
               $beneficioSocial->save();

               return redirect()->route('beneficios_sociais.index')
                   ->with('msg', 'Benefício adicionado com sucesso!');
           }
           catch (Throwable $t) {
               return redirect()->route('beneficios_sociais.index')
                   ->with('error', "Ocorreu um erro inesperado, tente novamente mais tarde");
           }
        });

        return $result;
    }

    public function update(Request $request, $id)
    {

        $beneficioSocial = BeneficioSocial::find($id);

        $result = DB::transaction(function() use ($request, $beneficioSocial) {
            try {
                $beneficioSocial->nome = $request->nome;
                $beneficioSocial->item = $request->item;
                $beneficioSocial->descricao = $request->descricao;
                $beneficioSocial->descricao_privada = $request->descricao_privada;
                $beneficioSocial->save();

                return redirect()->route('beneficios_sociais.index')
                    ->with('msg', 'Benefício atualizado com sucesso!');
            }
            catch (\Throwable $t) {
                return redirect()->route('beneficios_sociais.index')
                    ->with('error', "Ocorreu um erro inesperado, tente novamente mais tarde!");
            }
        });

        return $result;
    }

    public function tipoOcorrenciasListar($beneficio_id)
    {
        return view('admin.beneficios_sociais.tipo_ocorrencias.index', [
            'tipo_ocorrencias' => TipoOcorrencia::pluck('nome', 'id'),
            'tipo_ocorrencias_cadastradas' => BeneficioSocial::find($beneficio_id)->tipoOcorrencias()->get()
        ]);
    }

    public function tipoOcorrenciasIncluir(Request $request, $beneficio_id)
    {
        $tipo_ocorrencia_id = $request->get('tipo_ocorrencia');

        $result = DB::transaction(function() use ($beneficio_id, $tipo_ocorrencia_id) {
            try {
                BeneficioSocial::find($beneficio_id)->tipoOcorrencias()->attach($tipo_ocorrencia_id);

                return redirect()->route('beneficio.tipo_ocorrencias.listar', $beneficio_id)
                    ->with('msg', 'Tipo de ocorrência adicionado com sucesso!');
            } catch (Throwable $t) {
                return redirect()->route('beneficio.tipo_ocorrencias.listar', $beneficio_id)
                    ->with('error', 'Atenção! dados duplicados!');
            }
        });

        return $result;
    }
}
