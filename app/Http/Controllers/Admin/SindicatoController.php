<?php

namespace App\Http\Controllers\Admin;

use App\Enum\PapelEnum;
use App\Enum\TipoParticipanteBeneficioEnum;
use App\Http\Controllers\Controller;
use App\Models\{
    Banco, TipoParticipanteBeneficio, User, Endereco, Pessoa, Sindicato, Empresa
};
use App\Http\Requests\CreateSindicatoFormRequest as SindicatoRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Throwable;

class SindicatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Sindicato::orderBy('created_at', 'desc')->get();

        return view('admin.sindicatos.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sindicatos.create-edit');
    }

    public function edit($id){
        $sindicato = Sindicato::find($id);

        return view('admin.sindicatos.create-edit',[
            'sindicato'     => $sindicato,
            'endereco'      => $sindicato->endereco(),
            'juridico'      => $sindicato->responsavelJuridico(),
            'presidente'    => $sindicato->presidente(),
            'banco'         => $sindicato->banco()
        ]);
    }

    public function update(Request $request,$id){
        $sindicato = Sindicato::find($id);

        $result = DB::transaction(function() use ($request,$sindicato) {
            try {
                $endereco = $sindicato->endereco();
                $endereco->rua = $request->rua;
                $endereco->numero = $request->numero;
                $endereco->complemento = $request->complemento;
                $endereco->bairro = $request->bairro;
                $endereco->cidade = $request->cidade;
                $endereco->uf = $request->uf;
                $endereco->cep = $request->cep;
                $endereco->save();

                $presidente = $sindicato->presidente();
                $presidente->nome = $request->presidente;
                $presidente->telefone_1 = $request->presidente_telefone_1;
                $presidente->telefone_2 = $request->presidente_telefone_2;
                $presidente->email = $request->presidente_email;
                $presidente->save();

                $responsavel_juridico = $sindicato->responsavelJuridico();
                $responsavel_juridico->nome = $request->responsavel_juridico;
                $responsavel_juridico->telefone_1 = $request->responsavel_juridico_telefone_1;
                $responsavel_juridico->telefone_2 = $request->responsavel_juridico_telefone_2;
                $responsavel_juridico->email = $request->responsavel_juridico_email;
                $responsavel_juridico->save();

                $banco = $sindicato->banco();
                $banco->banco = $request->banco;
                $banco->conta = $request->conta;
                $banco->agencia = $request->agencia;
                $banco->save();

                $sindicato->logo = $request->logo;
                $sindicato->sigla = $request->sigla;
                $sindicato->razao_social = $request->razao_social;
                $sindicato->cnpj = removeMaskCnpj($request->cnpj);
                $sindicato->numero_trabalhadores = $request->numero_trabalhadores;
                $sindicato->email = $request->email;
                $sindicato->telefone_1 = $request->telefone_1;
                $sindicato->telefone_2 = $request->telefone_2;


                $sindicato->save();

                return redirect()->route('sindicatos.index')
                    ->with('msg', 'Sindicato Atualizado com sucesso!');
            }
            catch (Throwable $t) {
                return redirect()->route('sindicatos.index')
                    ->with('error', "Ocorreu um erro inesperado, tente novamente mais tarde");
            }
        }, 2);

        return $result;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SindicatoRequest $request)
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

                $presidente = new Pessoa();
                $presidente->nome = $request->presidente;
                $presidente->telefone_1 = $request->presidente_telefone_1;
                $presidente->telefone_2 = $request->presidente_telefone_2;
                $presidente->email = $request->presidente_email;
                $presidente->save();

                $responsavel_juridico = new Pessoa();
                $responsavel_juridico->nome = $request->responsavel_juridico;
                $responsavel_juridico->telefone_1 = $request->responsavel_juridico_telefone_1;
                $responsavel_juridico->telefone_2 = $request->responsavel_juridico_telefone_2;
                $responsavel_juridico->email = $request->responsavel_juridico_email;
                $responsavel_juridico->save();

                $responsavel_acesso = new Pessoa();
                $responsavel_acesso->nome = $request->responsavel_acesso;
                $responsavel_acesso->telefone_1 = $request->responsavel_acesso_telefone_1;
                $responsavel_acesso->telefone_2 = $request->responsavel_acesso_telefone_2;
                $responsavel_acesso->email = $request->responsavel_acesso_email;
                $responsavel_acesso->save();

                $banco = new Banco;
                $banco->banco = $request->banco;
                $banco->conta = $request->conta;
                $banco->agencia = $request->agencia;
                $banco->save();

                $sindicato = new Sindicato;
                $sindicato->logo = $request->logo;
                $sindicato->sigla = $request->sigla;
                $sindicato->razao_social = $request->razao_social;
                $sindicato->cnpj = removeMaskCnpj($request->cnpj);
                $sindicato->numero_trabalhadores = $request->numero_trabalhadores;
                $sindicato->email = $request->email;
                $sindicato->telefone_1 = $request->telefone_1;
                $sindicato->telefone_2 = $request->telefone_2;

                $sindicato->endereco_id = $endereco->id;
                $sindicato->presidente = $presidente->id;
                $sindicato->responsavel_juridico = $responsavel_juridico->id;
                $sindicato->responsavel_acesso = $responsavel_acesso->id;
                $sindicato->banco_id = $banco->id;
                $sindicato->save();

                $user = new User();
                $user->name = $request->responsavel_acesso;
                $user->email = $request->responsavel_acesso_email;
                $user->password = bcrypt($request->responsavel_acesso_password);
                $user->papel_id = PapelEnum::SINDICATO;
                $user->sindicato_id = $sindicato->id;
                $user->save();

                return redirect()->route('sindicatos.index')
                    ->with('msg', 'Sindicato Cadastrado com sucesso!');
            }
            catch (Throwable $t) {
                return redirect()->route('sindicatos.index')
                    ->with('error', "Ocorreu um erro inesperado, tente novamente mais tarde");
            }
        }, 2);

        return $result;
    }

    public function participantesListar($sindicato_id) {
        $tipo_participantes = TipoParticipanteBeneficio::all();
        $participante_beneficios = $tipo_participantes->first()->participanteBeneficioSociais()->pluck('cnpj', 'id');

        return view('admin.sindicatos.participantes_beneficio.index', [
            'sindicato'                 => Sindicato::find($sindicato_id),
            'tipo_participantes'        => $tipo_participantes->pluck('nome', 'id'),
            'participante_beneficios'   => $participante_beneficios,
            'participantes_cadastrados' => $this->montarParticipantesBeneficio($sindicato_id)
        ]);
    }

    public function participantesIncluir(Request $request, $sindicato_id)
    {
        $data = [
            'sindicato'         => Sindicato::find($sindicato_id),
            'participante_id'   => $request->get('participante_beneficio'),
            'valor_beneficio'   => toMoney($request->get('valor_beneficio_social')),
            'tipo_participante' => $request->get('tipo_participante')
        ];

        $result = DB::transaction(function() use ($data, $sindicato_id) {
            try {

                if($data['tipo_participante'] == TipoParticipanteBeneficioEnum::EMPRESA_PARCEIRA) {
                    $data['sindicato']->empresaParceiras()
                        ->attach($data['participante_id'], [
                            'valor_beneficio_social' => $data['valor_beneficio']
                        ]);
                }
                else {
                    $data['sindicato']->participanteBeneficioSociais()
                        ->attach($data['participante_id'], [
                            'valor_beneficio_social' => $data['valor_beneficio']
                        ]);
                }

                return redirect()->route('sindicato.participantes.listar', $sindicato_id)
                    ->with('msg', 'Participante adicionado com sucesso!');
            } catch (Throwable $t) {
                return redirect()->route('sindicato.participantes.listar', $sindicato_id)
                    ->with('error', 'Atenção! dados duplicados!');
            }
        });

        return $result;
    }

    public function montarParticipantesBeneficio($sindicato_id)
    {
        $participantes = [];
        $sindicato = Sindicato::find($sindicato_id);

        foreach($sindicato->participanteBeneficioSociais()->get() as $item) {
            $participantes[] = $item;
        }

        foreach($sindicato->empresaParceiras()->get() as $item) {
            $participantes[] = $item;
        }

        return $participantes;
    }

    //API
    public function pegarCategorias($id) {
        return response()->json(Sindicato::find($id)->categoriaSindicatos());
    }

    public function pegarCategoriasPorIdEmpresa($sindicato_id, $empresa_id) {
        $categoria_sindicatos = Empresa::find($empresa_id)->categoriaSindicatos()->get()
            ->where('sindicato_id', $sindicato_id);
        
        return response()->json($categoria_sindicatos);
    }
}
