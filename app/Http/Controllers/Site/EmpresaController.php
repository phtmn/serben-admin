<?php

namespace App\Http\Controllers\Site;

use App\Enum\PapelEnum;
use App\Models\{
    Contabilidade, Empresa, Endereco, Responsavel, User, Setor,Cobranca
};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Throwable;
use App\Http\Requests\CreateEmpresaFormRequest as EmpresaRequest;
use Auth;
use Carbon\Carbon;

class EmpresaController extends Controller
{
    private $empresa;
    private $cobranca;

    public function __construct(Empresa $empresa,Cobranca $cobranca)
    {
        $this->empresa = $empresa;
        $this->cobranca = $cobranca;
    }


    public function index(){
        //dd('s');
        $data = auth()->user()->sindicato()->empresas()->get();
        //dd($data);
        return view('site.sindicato.empresas.index',compact('data'));
    }

    public function create(){
        return view('site.sindicato.empresas.create-edit', [
            'setores' => Setor::pluck('nome', 'id'),
            'categoria_sindicatos' => auth()->user()->sindicato()->categoriaSindicatos()->pluck('nome', 'id')
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
                $empresa->cnpj = $request->cnpj;
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

                $empresa->sindicatos()->attach(auth()->user()->sindicato()->id);
                $empresa->categoriaSindicatos()->attach($request->categoria_sindicato);

                $user_empresa->empresa_id = $empresa->id;
                $user_empresa->save();

                if ($request->get('contabilidade_cnpj')) {
                    $user_contabilidade->empresa_id = $empresa->id;
                    $user_contabilidade->save();
                }

                return redirect()->route('sindicato-empresas.index')
                    ->with('msg', 'Empresa Cadastrada com sucesso!');
            }
            catch (Throwable $t) {
                return redirect()->route('sindicato-empresas.index')
                    ->with('error', "Ocorreu um erro inesperado, tente novamente mais tarde" );
            }
        });

        return $result;
    }

    public function segundaVia(){
        $data = DB::table('cobrancas')
                    ->where('empresa_id',Auth::user()->empresa()->id)
                    //->where('ocorrenciaDescricao','=','Entrada Confirmada')
                    ->get();
        return view('site.empresa.financeiro.index',compact('data'));
    }

    public function segundaViaBoleto($cobranca_id){

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
                    'descricaoDemonstrativo' => ['Cobrança Teste'],
                    'instrucoes'             => ['instrucao 1', 'instrucao 2', 'instrucao 3'],
                    'aceite'                 => 'S',
                    'especieDoc'             => 'DM',
                ]
            );

            $pdf = new \Eduardokum\LaravelBoleto\Boleto\Render\Pdf();
            $pdf->addBoleto($boleto);
            $pdf->gerarBoleto($pdf::OUTPUT_DOWNLOAD,null,'boleto.pdf');

            //$path = storage_path('cobrancas\cobranca.pdf');
            //$pdf->gerarBoleto($pdf::OUTPUT_SAVE, $path);
            //$empresa = Empresa::find($cobranca->empresa->id);
            //Mail::to('erico@serbensocial.com.br')->send(new EnviarCobranca());

        }catch(\Exception $e){
            return "Erro ao gerar boleto".$e->getMessage();
        }
    }
}
