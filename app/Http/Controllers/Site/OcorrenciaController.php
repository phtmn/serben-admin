<?php

namespace App\Http\Controllers\Site;

use App\Enum\StatusOcorrenciaEnum;
use App\Models\{
    DetalhamentoTipoOcorrencia, Ocorrencia, TipoOcorrencia, Trabalhador
};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Throwable;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateOcorrenciaFormRequest as OcorrenciaRequest;

class OcorrenciaController extends Controller
{
    public function index(){

        return view('site.trabalhador.ocorrencias', [
            'data' => auth()->user()->trabalhador()->ocorrencias()
        ]);
    }

    public function create(){
        return view('site.empresa.ocorrencias.create-edit', [
            'tipoOcorrencias' => TipoOcorrencia::pluck('nome', 'id')
        ]);
    }

    public function store(OcorrenciaRequest $request){
        $result = DB::transaction(function() use ($request) {
           try {
               // procura o trabalhador
               $trabalhador = Trabalhador::where('cpf', removeMaskCpf($request->cpf_trabalhador))->first();

               $ocorrencia = new Ocorrencia;
               $ocorrencia->nome_responsavel = $request->nome_responsavel;
               $ocorrencia->departamento = $request->departamento;

               $ocorrencia->trabalhador_id = $trabalhador->id;
               $ocorrencia->tipo_ocorrencia_id = $request->tipo_ocorrencia;
               $ocorrencia->beneficio_social_id = $request->beneficio;
               $ocorrencia->status_ocorrencia_id = StatusOcorrenciaEnum::ABERTA;
               $ocorrencia->save();

               $detalhamentoOcorrencia = new DetalhamentoTipoOcorrencia;
               $detalhamentoOcorrencia->tipo_morte = $request->tipo_morte;
               $detalhamentoOcorrencia->data_ocorrencia = $request->data_ocorrencia;
               $detalhamentoOcorrencia->atestado_obito = $request->atestado_obito;
               $detalhamentoOcorrencia->carta_concessao = $request->carta_concessao;
               $detalhamentoOcorrencia->certidao_casamento_uniao_estavel = $request->certidao_casamento_uniao_estavel;
               $detalhamentoOcorrencia->informacoes_doenca = $request->informacoes_doenca;
               $detalhamentoOcorrencia->laudo_medico = $request->laudo_medico;
               $detalhamentoOcorrencia->outro_beneficio = $request->outro_beneficio;
               $detalhamentoOcorrencia->ocorrencia_id = $ocorrencia->id;
               $detalhamentoOcorrencia->save();

               return redirect()->route('empresa-trabalhadores.index')
                   ->with('msg', "Ocorrência cadastrada com sucesso para $trabalhador->nome!");
           }
           catch (Throwable $t) {
               return redirect()->route('empresa-trabalhadores.index')
                   ->with('error', "Ocorreu um erro inesperado, tente novamente mais tarde" );
           }
        });

        return $result;
    }
}
