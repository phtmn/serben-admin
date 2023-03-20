<?php

namespace App\Http\Controllers\Financeiro;

use App\Mail\EnviarCobranca;
use App\Models\Empresa;
use App\Models\Cobranca;
use App\Models\Remessa;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class BoletoController extends Controller
{
    private $empresa;
    private $cobranca;

    public function __construct(Empresa $empresa,Cobranca $cobranca)
    {
        $this->empresa = $empresa;
        $this->cobranca = $cobranca;
    }

    public function gerarBoleto($cobranca_id){

        $cobranca       = $this->cobranca->find($cobranca_id);
        $pagador        = $this->empresa->gerarPagador($cobranca->empresa->id);
        $beneficiario   = $this->empresa->gerarBeneficiario();

        try{

            $boleto = new \Eduardokum\LaravelBoleto\Boleto\Banco\Bradesco(
                [
                    'logo'                   => asset('/images/logotipo.png'),
                    'dataVencimento'         => Carbon::parse($cobranca->data_cobranca),
                    'valor'                  => $cobranca->valor_cobranca,
                    'multa'                  => false,
                    'juros'                  => false,
                    'numero'                 => $cobranca->id,
                    'numeroDocumento'        => $cobranca->id,
                    'numeroControle'         => $cobranca->id,
                    'pagador'                => $pagador,
                    'beneficiario'           => $beneficiario,
                    'carteira'               => '26',
                    'agencia'                => '0515',
                    'conta'                  => '006012',
                    'contaDv'                => 7,
                    //'descricaoDemonstrativo' => ['Cobrança Teste'],
                    //'instrucoes'             => ['instrucao 1', 'instrucao 2', 'instrucao 3'],
                    'aceite'                 => 'S',
                    'especieDoc'             => 'DM',
                ]
            );

            $pdf = new \Eduardokum\LaravelBoleto\Boleto\Render\Pdf();
            $pdf->addBoleto($boleto);
            $path = storage_path('cobrancas\cobranca.pdf');
            $pdf->gerarBoleto($pdf::OUTPUT_SAVE, $path);

            $empresa = Empresa::find($cobranca->empresa->id);

            Mail::to($empresa->email_avisos_mensais)->send(new EnviarCobranca());
            return redirect()->back()->with('msg','Boleto Enviado com sucesso');


        }catch(\Exception $e){
            return "Erro ao gerar boleto".$e->getMessage();
        }
    }

    public function gerarRemessa(){

        if($this->cobranca->where('remessa',0)->count() == 0){
            return redirect()->back()->with('error','Não existem cobranças para processar');
        }

        $remessa = new Remessa();
        $remessa->agencia   = '00515';
        $remessa->carteira  = '026';
        $remessa->conta     = '006012';
        $remessa->contaDv   = '7';
        $remessa->codigoCliente = '5090715';
        $remessa->data_processamento = Carbon::now();
        $remessa->save();


        $beneficiario = $this->empresa->gerarBeneficiario();
        $remessa = new \Eduardokum\LaravelBoleto\Cnab\Remessa\Cnab400\Banco\Bradesco(
            [
                'idRemessa'     => $remessa->id,
                'agencia'       => '00515',
                'carteira'      => '026',
                'conta'         => '006012',
                'contaDv'       => 7,
                'codigoCliente' => '5090715',
                'beneficiario'  => $beneficiario,
            ]
        );

        $cobrancas = $this->cobranca->where('remessa',0)->get();

        try{
            foreach($cobrancas as $c) {
                $pagador = $this->empresa->gerarPagador($c->empresa->id);
                $boleto = new \Eduardokum\LaravelBoleto\Boleto\Banco\Bradesco(
                    [
                        'logo'              => asset('/images/logotipo.png'),
                        'dataVencimento'    => Carbon::parse($c->data_cobranca),
                        'valor'             => $c->valor_cobranca,
                        'multa'             => false,
                        'juros'             => false,
                        'numero'            => $c->id,
                        'numeroDocumento'   => $c->id,
                        'numeroControle '   => $c->id,
                        'pagador'           => $pagador,
                        'beneficiario'      => $beneficiario,
                        'carteira'          => '26',
                        'agencia'           => '0515',
                        'conta'             => '006012',
                        'contaDv'           => 7,
                        //'descricaoDemonstrativo' => ['Cobrança Teste'],
                        //'instrucoes'        => ['instrucao 1', 'instrucao 2', 'instrucao 3'],
                        'aceite'            => 'S',
                        'especieDoc'        => 'DM',
                    ]
                );
                $remessa->addBoleto($boleto);
            }

           foreach ($cobrancas as $c){
                Cobranca::where('id',$c->id)->update([
                    'remessa' => 1
                ]);
           }

            $remessa->download('RECB.txt');
        }catch (\Exception $e) {
            return 'Erro ao gerar remessa'. $e->getMessage();
        }

    }




}
