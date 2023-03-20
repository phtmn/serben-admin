<?php

namespace App\Http\Controllers\Site;

use App\Enum\PapelEnum;
use App\Models\{
    Endereco, Trabalhador, User
};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Throwable;
use App\Http\Requests\Site\CreateTrabalhadorFormRequest as TrabalhadorRequest;

class TrabalhadorController extends Controller
{
    public function index(){
        $data = auth()->user()->empresa()->trabalhadores();
        return view('site.empresa.trabalhadores.index',compact('data'));
    }

    public function create(){
        $empresa = auth()->user()->empresa();

        if($empresa->categoriaSindicatos()->get()->isEmpty()) {
            return redirect()->route('empresa-trabalhadores.index')
                ->with('error', "Entre em contato com a Serben, pois sua empresa não possui sindicatos!");
        }

        $sindicatos = $empresa->sindicatos()->get();
        $categoria_sindicatos = $empresa->categoriaSindicatos()->get()
            ->where('sindicato_id', $sindicatos->first()->id);

        $sindicatos = $sindicatos->pluck('cnpj', 'id');
        $categoria_sindicatos = $categoria_sindicatos->pluck('nome', 'id');

        return view('site.empresa.trabalhadores.create-edit', [
            'categoria_sindicatos'  => $categoria_sindicatos,
            'sindicatos'            => $sindicatos
        ]);
    }

    public function store(TrabalhadorRequest $request){
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
                $trabalhador->empresa_id = auth()->user()->empresa()->id;
                $trabalhador->categoria_sindicato_id = $request->categoria_sindicato;
                $trabalhador->save();

                if ($request->email and $request->password) {
                    $user = new User;
                    $user->name = $request->nome;
                    $user->email = $request->email;
                    $user->password = bcrypt($request->password);
                    $user->papel_id = PapelEnum::TRABALHADOR;
                    $user->trabalhador_id = $trabalhador->id;
                    $user->save();
                }

                return redirect()->route('empresa-trabalhadores.index')
                    ->with('msg', 'Trabalhador Cadastrado com sucesso!');
            }
            catch (Throwable $t) {
                return redirect()->route('empresa-trabalhadores.index')
                    ->with('error', "Ocorreu um erro inesperado, tente novamente mais tarde");
            }
        });

        return $result;
    }

    // API
    public function getByCpf($cpf) {
        $user = auth()->user();
        $trabalhador = $user->trabalhador();

        if (!auth()->check()) return response()->json(["guest" => true]);

        if ($trabalhador and $trabalhador->cpf != $cpf) return response()->json(['block' => true]);

        switch($user) {
            case $user->isSerben():
                return response()->json(Trabalhador::where('cpf', $cpf)->first());
            case $user->isSindicato():
                return response()->json($this->pegarTrabalhadorPorCategoriaSindicatos($user->sindicato()->categoriaSindicatos(), $cpf));
            case $user->isEmpresa():
                return response()->json($user->empresa()->trabalhadores()->where('cpf', $cpf)->first());
            case $user->isTrabalhador():
                return response()->json($user->trabalhador());
        }

        return response()->json(["guest" => true]);
    }

    public function pegarBeneficiosDoTipoOcorrencia($cpf, $tipo_id)
    {
        $beneficios = Trabalhador::where('cpf', $cpf)->first()
            ->categoriaSindicato()
            ->beneficioSociais()->wherePivot('ehTrabalhador', true)->get()
            ->filter(function ($beneficio, $key) use ($tipo_id) {
                return ($beneficio->tipoOcorrencias()->where('tipo_ocorrencia_id', $tipo_id)->count());
            });

        return response()->json($beneficios);
    }

    public function pegarOcorrencia($cpf)
    {
        $trabalhador = Trabalhador::where('cpf', $cpf)->first();

        return response()->json($trabalhador->ocorrencias());
    }

    public function listarOcorrencias()
    {
        return view('site.sindicato.ocorrencias.create-edit');
    }

    public function pegarTrabalhadorPorCategoriaSindicatos($categoria_sindicatos, $cpf) {
        foreach ($categoria_sindicatos as $categoria) {
            $trabalhador = $categoria->trabalhadores()->where('cpf', $cpf)->first();
            if ($trabalhador) {
                return $trabalhador;
            }
        }

        return null;
    }

    public function listarBeneficios() {
        $categoriaSindicato = auth()->user()->trabalhador()->categoriaSindicato();

        return view('site.trabalhador.beneficios.index', [
            'categoria'     => $categoriaSindicato,
            'beneficios'    => $categoriaSindicato->beneficioSociais()->wherePivot('ehTrabalhador', true)->get()
        ]);
    }
}
