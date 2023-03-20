<?php

namespace App\Http\Controllers\Admin;

use App\Models\StatusOcorrencia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ocorrencia;
use Illuminate\Support\Facades\DB;
use Throwable;

class OcorrenciasController extends Controller
{
    public function index(){

        return view('admin.ocorrencias.index',[
            'data' => Ocorrencia::all()
        ]);
    }

    public function edit($id) {
        $ocorrencia = Ocorrencia::find($id);

        return view('admin.ocorrencias.create-edit', [
            'ocorrencia'                    => $ocorrencia,
            'tipos_ocorrencias'             => $ocorrencia->tipoOcorrencia()->pluck('nome', 'id'),
            'beneficios_sociais'            => $ocorrencia->beneficioSocial()->pluck('nome', 'id'),
            'status_ocorrencias'            => StatusOcorrencia::pluck('nome', 'id'),
            'tipo_ocorrencia_cadastrada'    => $ocorrencia->tipoOcorrencia(),
            'beneficio_cadastrado'          => $ocorrencia->beneficioSocial(),
            'status_ocorrencia_cadastrada'  => $ocorrencia->statusOcorrencia()
        ]);
    }

    public function update(Request $request, $id) {
        $ocorrencia = Ocorrencia::find($id);

        $result = DB::transaction(function() use ($request, $ocorrencia) {
            try {
                $ocorrencia->nome_responsavel = $request->nome_responsavel;
                $ocorrencia->departamento = $request->departamento;

                $ocorrencia->status_ocorrencia_id = $request->status_ocorrencia;
                $ocorrencia->save();

                return redirect()->route('ocorrencias.index')
                    ->with('msg', "Ocorrência atualizada com sucesso!");
            }
            catch (Throwable $t) {
                return redirect()->route('empresa-trabalhadores.index')
                    ->with('error', "Ocorreu um erro inesperado, tente novamente mais tarde" );
            }
        });

        return $result;
    }
}
