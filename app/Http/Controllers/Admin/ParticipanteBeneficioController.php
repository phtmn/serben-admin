<?php

namespace App\Http\Controllers\Admin;

use App\Enum\PapelEnum;
use App\Http\Controllers\Controller;
use App\Models\{
    Banco, Endereco, ParticipanteBeneficioSocial, Pessoa, TipoParticipanteBeneficio, User
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateParticipanteBeneficioFormRequest as ParticipanteBeneficioRequest;

class ParticipanteBeneficioController extends Controller
{
    public function index()
    {
        return view('admin.participante_beneficios.index', [
            'data' => ParticipanteBeneficioSocial::all()
        ]);
    }

    public function create()
    {
        return view('admin.participante_beneficios.create-edit', [
            'tipo_participantes' => TipoParticipanteBeneficio::pluck('nome', 'id')->forget(5)
        ]);
    }

    public function edit($id)
    {
        $participante_beneficio = ParticipanteBeneficioSocial::find($id);

        return view('admin.participante_beneficios.create-edit', [
            'participante_beneficio'        => $participante_beneficio,
            'tipo_participantes'            => TipoParticipanteBeneficio::pluck('nome', 'id')->forget(5),
            'tipo_participante_cadastrado'  => $participante_beneficio->tipoParticipanteBeneficio(),
            'endereco'                      => $participante_beneficio->endereco(),
            'juridico'                      => $participante_beneficio->responsavelJuridico(),
            'presidente'                    => $participante_beneficio->presidente(),
            'banco'                         => $participante_beneficio->banco()
        ]);
    }

    public function store(ParticipanteBeneficioRequest $request)
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

               $presidente = new Pessoa;
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

               $participanteBeneficio = new ParticipanteBeneficioSocial;
               $participanteBeneficio->logo = $request->logo;
               $participanteBeneficio->sigla = $request->sigla;
               $participanteBeneficio->razao_social = $request->razao_social;
               $participanteBeneficio->cnpj = removeMaskCnpj($request->cnpj);
               $participanteBeneficio->numero_trabalhadores = $request->numero_trabalhadores;
               $participanteBeneficio->email = $request->email;
               $participanteBeneficio->telefone_1 = $request->telefone_1;
               $participanteBeneficio->telefone_2 = $request->telefone_2;

               $participanteBeneficio->tipo_participante_beneficio_id = $request->tipo_participante;
               $participanteBeneficio->endereco_id = $endereco->id;
               $participanteBeneficio->presidente = $presidente->id;
               $participanteBeneficio->responsavel_juridico = $responsavel_juridico->id;
               $participanteBeneficio->responsavel_acesso = $responsavel_acesso->id;
               $participanteBeneficio->banco_id = $banco->id;
               $participanteBeneficio->save();

               $user = new User;
               $user->name = $request->responsavel_acesso;
               $user->email = $request->responsavel_acesso_email;
               $user->password = bcrypt($request->responsavel_acesso_password);
               $user->papel_id = PapelEnum::SINDICATO;
               $user->sindicato_id = $participanteBeneficio->id;
               $user->save();

               return redirect()->route('participante_beneficios.index')
                   ->with('msg', 'Participante adicionado com sucesso!');
           }
           catch (\Throwable $t) {
               return redirect()->route('participante_beneficios.index')
                   ->with('error', "Ocorreu um erro inesperado, tente novamento mais tarde! ");
           }
        });

        return $result;
    }

    public function update(Request $request, $id)
    {
        $participante_beneficio = ParticipanteBeneficioSocial::find($id);

        $result = DB::transaction(function() use ($request, $participante_beneficio) {
            try {
                $endereco = $participante_beneficio->endereco();
                $endereco->rua = $request->rua;
                $endereco->numero = $request->numero;
                $endereco->complemento = $request->complemento;
                $endereco->bairro = $request->bairro;
                $endereco->cidade = $request->cidade;
                $endereco->uf = $request->uf;
                $endereco->cep = $request->cep;
                $endereco->save();

                $presidente = $participante_beneficio->presidente();
                $presidente->nome = $request->presidente;
                $presidente->telefone_1 = $request->presidente_telefone_1;
                $presidente->telefone_2 = $request->presidente_telefone_2;
                $presidente->email = $request->presidente_email;
                $presidente->save();

                $responsavel_juridico = $participante_beneficio->responsavelJuridico();
                $responsavel_juridico->nome = $request->responsavel_juridico;
                $responsavel_juridico->telefone_1 = $request->responsavel_juridico_telefone_1;
                $responsavel_juridico->telefone_2 = $request->responsavel_juridico_telefone_2;
                $responsavel_juridico->email = $request->responsavel_juridico_email;
                $responsavel_juridico->save();

                $banco = $participante_beneficio->banco();
                $banco->banco = $request->banco;
                $banco->conta = $request->conta;
                $banco->agencia = $request->agencia;
                $banco->save();

                $participante_beneficio->logo = $request->logo;
                $participante_beneficio->sigla = $request->sigla;
                $participante_beneficio->razao_social = $request->razao_social;
                $participante_beneficio->cnpj = removeMaskCnpj($request->cnpj);
                $participante_beneficio->numero_trabalhadores = $request->numero_trabalhadores;
                $participante_beneficio->email = $request->email;
                $participante_beneficio->telefone_1 = $request->telefone_1;
                $participante_beneficio->telefone_2 = $request->telefone_2;

                $participante_beneficio->tipo_participante_beneficio_id = $request->tipo_participante;
                $participante_beneficio->save();

                return redirect()->route('participante_beneficios.index')
                    ->with('msg', 'Participante atualizado com sucesso!');
            }
            catch (\Throwable $t) {
                return redirect()->route('participante_beneficios.index')
                    ->with('error', "Ocorreu um erro inesperado, tente novamente mais tarde");
            }
        });

        return $result;
    }

    public function pegarParticipantesPorTipo($tipoParticipante) {
        return response()->json(TipoParticipanteBeneficio::find($tipoParticipante)->participanteBeneficioSociais());
    }
}
