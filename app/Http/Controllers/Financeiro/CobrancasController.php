<?php

namespace App\Http\Controllers\Financeiro;

use App\Enum\StatusPagamentoEnum;
use App\Models\Repasse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Sindicato;
use App\Models\Cobranca;
use App\Http\Controllers\Controller;

class CobrancasController extends Controller
{
    protected $empresa;
    protected $sindicato;
  
    public function __construct(Empresa $empresa, Sindicato $sindicato){
        $this->empresa = $empresa;        
    }

    public function index(){
         
        $empresas = $this->empresa->pluck('razao_social','id');
        $data     = Cobranca::all();

        return view('admin.financeiro.cobrancas.index',[
            'data'          => $data,
            'empresas'      => $empresas,
            'confirmadas'   => $data->where('ocorrenciaDescricao','=','Entrada Confirmada')->sum('valor_cobranca'),
            'enviadas'      => $data->where('ocorrenciaDescricao','=','Em processamento')->sum('valor_cobranca'),
            'pagas'         => $data->where('ocorrencia','=','06')->sum('valor_cobranca'),
        ]);
    }

    public function store(Request $request)
    {
        $empresa = $this->empresa->find($request->empresa_id);

        $valor_boleto =0;
        $sindicatos         = $empresa->sindicatos()->get();
        $qtd_trabalhadores  = $empresa->trabalhadores()->count();

        foreach($empresa->categoriaSindicatos()->get() as $cs){
            $valor_boleto += $cs->trabalhadores()
                        ->where('empresa_id', $empresa->id)
                        ->count() * $cs->valor_beneficio;
        }

        $cobranca = new Cobranca();
        $cobranca->empresa_id           = $empresa->id;
        $cobranca->valor_cobranca       = $valor_boleto + 2.20;
        $cobranca->data_cobranca        = $request->data_cobranca;
        $cobranca->ocorrenciaDescricao  = 'Em processamento';
        $cobranca->remessa              = 0;
        $cobranca->status_pagamento_id  = StatusPagamentoEnum::GERADO;
        $cobranca->save();

        $repasses = $this->calcularRepasses($qtd_trabalhadores,$sindicatos);

        if($repasses->isNotEmpty()){
            $this->gravaRepasses($repasses,$cobranca);
            return redirect()->route('cobrancas.show',$cobranca->id);
        }else{
            return redirect()->route('cobrancas.show',$cobranca->id);
        }
    }

    public function calcularRepasses($qtd_trabalhadores,$sindicatos){

        $repasses = collect([]);

        foreach($sindicatos as $s) {
           foreach ($s->participanteBeneficioSociais()->get() as $pa) {
               $repasses->push([
                   'participante_id' => $pa->id,
                   'valor'           => $pa->pivot->valor_beneficio_social * $qtd_trabalhadores
               ]);
           }
        }
        return $repasses;
    }


    public function gravaRepasses($repasses,$cobranca){

        foreach($repasses as $rep){
            $repasse = new Repasse();
            $repasse->cobranca_id           = $cobranca->id;
            $repasse->participante_id       = $rep['participante_id'];
            $repasse->status_pagamento_id   = StatusPagamentoEnum::GERADO;
            $repasse->valor_repasse         = $rep['valor'];
            $repasse->data_repasse          = $cobranca->data_cobranca;
            $repasse->data_pagamento        = null;
            $repasse->save();
        }

        if($repasse){
            return true;
        }
    }

    public function show($cobranca){

        $cobranca = Cobranca::Find($cobranca);
        $empresa  = $cobranca->empresa()->first();
        $repasses = $cobranca->repasses()->get();

        //dd($empresa->trabalhadores()->count());
        return view('admin.financeiro.cobrancas.show', [
            'cobranca'      => $cobranca,
            'empresa'       => $empresa,
            'sindicatos'    => $empresa->sindicatos()->get(),
            'categorias'    => $empresa->categoriaSindicatos()->get(),
            'valor_boleto'  => $cobranca->valor_cobranca,
            'repasses'      => $repasses
        ])->with('msg', 'Cobrança Incluída');
    }

    public function retorno(Request $request){

        $arquivo = $request->file('retorno')->getRealPath();

        $retorno = \Eduardokum\LaravelBoleto\Cnab\Retorno\Factory::make($arquivo);
        $retorno->processar();
        //dd($retorno->getDetalhes());
        $cobrancas = $retorno->getDetalhes();

        foreach ( $cobrancas as $c){

            Cobranca::where('id',$c->numeroControle)->update([
                'ocorrencia'            => $c->ocorrencia,
                'ocorrenciaTipo'        => $c->ocorrenciaTipo,
                'ocorrenciaDescricao'   => $c->ocorrenciaDescricao,
                'data_credito'          => dataBanco($c->dataCredito),
                'data_ocorrencia'       => dataBanco($c->dataOcorrencia),
                'nosso_numero'          => $c->nossoNumero,
                'numero_controle'       => $c->numeroControle,
                'valor_tarifa'          => $c->valorTarifa,
                'valor_recebido'        => $c->valorRecebido
            ]);
        }
        return redirect()->back()->with('msg','Arquivo Processado com Sucesso');
    }
}
