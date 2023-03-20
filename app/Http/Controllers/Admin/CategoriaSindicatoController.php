<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    BeneficioSocial, CategoriaSindicato, Sindicato
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class CategoriaSindicatoController extends Controller
{
    public function index($sindicato_id)
    {
        return view('admin.sindicatos.categorias.index', [
            'sindicato' => Sindicato::find($sindicato_id),
            'data' => Sindicato::find($sindicato_id)->categoriaSindicatos()
        ]);
    }

    public function create()
    {
        return view('admin.sindicatos.categorias.create-edit');
    }

    public function store(Request $request)
    {
        $file_path = '';

        if($request->cct){
            $file =  $request->file('cct');
            $name  = $file->getClientOriginalName();
            $path  = public_path('files/cct');
            $file_path = '/files/cct/'.$name;
            $file->move($path,$name);
        }
        $result = DB::transaction(function() use ($request,$file_path) {
           try {
               $categoriaSindicato = new CategoriaSindicato;
               $categoriaSindicato->nome = $request->categoria;
               $categoriaSindicato->cct = $file_path;
               $categoriaSindicato->valor_beneficio = toMoney($request->valor_beneficio);
               $categoriaSindicato->sindicato_id = $request->sindicato;
               $categoriaSindicato->save();

               return redirect()->route('sindicato.categorias.listar', $request->sindicato)
                   ->with('msg', 'Categoria adicionada com sucesso!');
           }
           catch (\Throwable $t) {
               return redirect()->route('sindicato.categorias.listar', $request->sindicato)
                   ->with('error', "Ocorreu um erro inesperado, tente novamente mais tarde" );
           }
        });

        return $result;
    }

    public function beneficiosListar($categoria_id)
    {
        return view('admin.sindicatos.categorias.beneficios.index', [
            'data' => CategoriaSindicato::find($categoria_id)->beneficioSociais()->get()
        ]);
    }

    public function beneficiosFormIncluir()
    {
        $opcoes = [
            'ehTrabalhador'     => 'trabalhador',
            'ehConjuge'         => 'cônjuge',
            'ehFilhosMenores'   => 'filhos menores',
            'ehEmpresa'         => 'empresa',
            'ehSindicato'       => 'entidade',
        ];

        return view('admin.sindicatos.categorias.beneficios.create-edit', [
            'opcoes' => $opcoes,
            'beneficios' => BeneficioSocial::pluck('nome', 'id')
        ]);
    }

    public function beneficiosFormAtualizar($categoria_id, $categoria_beneficio_id)
    {
        $beneficio_cadastrado = CategoriaSindicato::find($categoria_id)->beneficioSociais()->wherePivot('id', $categoria_beneficio_id)->first();

        $opcoes = [
            'ehTrabalhador'     => 'trabalhador',
            'ehConjuge'         => 'cônjuge',
            'ehFilhosMenores'   => 'filhos menores',
            'ehEmpresa'         => 'empresa',
            'ehSindicato'       => 'entidade',
        ];

        return view('admin.sindicatos.categorias.beneficios.create-edit', [
            'opcoes'                    => $opcoes,
            'beneficios'                => BeneficioSocial::pluck('nome', 'id'),
            'beneficio_cadastrado'      => $beneficio_cadastrado,
            'opcao_cadastrada'          => $this->pegarOpcaoCadastrada($beneficio_cadastrado),
            'numero_parcelas'           => $beneficio_cadastrado->pivot->numero_parcelas,
            'quantidade_kit'            => $beneficio_cadastrado->pivot->quantidade_kit,
            'valor'                     => toMoney($beneficio_cadastrado->pivot->valor),
            'categoria_id'              => $categoria_id,
            'categoria_beneficio_id'    => $categoria_beneficio_id
        ]);
    }

    public function beneficiosIncluir(Request $request, $categoria_id)
    {
        $opcao = $request->get('opcao');

        $data = [
            'categoria'         => CategoriaSindicato::find($categoria_id),
            'beneficio_id'      => $request->get('beneficio'),
            'ehTrabalhador'     => ($opcao == 'ehTrabalhador'),
            'ehConjuge'         => ($opcao == 'ehConjuge'),
            'ehFilhosMenores'   => ($opcao == 'ehFilhosMenores'),
            'ehEmpresa'         => ($opcao == 'ehEmpresa'),
            'ehSindicato'       => ($opcao == 'ehSindicato'),
            'numero_parcelas'   => $request->get('numero_parcelas'),
            'quantidade_kit'    => $request->get('quantidade_kit'),
            'valor'             => toMoney($request->get('valor'))
        ];

        $result = DB::transaction(function() use ($data, $categoria_id) {
            try {

                $data['categoria']->beneficioSociais()
                    ->attach($data['beneficio_id'], [
                        'ehTrabalhador'     => $data['ehTrabalhador'],
                        'ehConjuge'         => $data['ehConjuge'],
                        'ehFilhosMenores'   => $data['ehFilhosMenores'],
                        'ehEmpresa'         => $data['ehEmpresa'],
                        'ehSindicato'       => $data['ehSindicato'],
                        'numero_parcelas'   => $data['numero_parcelas'],
                        'quantidade_kit'    => $data['quantidade_kit'],
                        'valor'             => $data['valor'],
                    ]);

                return redirect()->route('categoria.beneficios.listar', $categoria_id)
                    ->with('msg', 'Benefício adicionado com sucesso!');
            } catch (Throwable $t) {
                return redirect()->route('categoria.beneficios.listar', $categoria_id)
                    ->with('error', "Ocorreu um erro inesperado, tente novamente mais tarde");
            }
        });

        return $result;
    }

    public function beneficiosAtualizar(Request $request, $categoria_id, $categoria_beneficio_id)
    {
        $opcao = $request->get('opcao');

        $data = [
            'categoria'         => CategoriaSindicato::find($categoria_id),
            'beneficio_id'      => $request->get('beneficio'),
            'ehTrabalhador'     => ($opcao == 'ehTrabalhador'),
            'ehConjuge'         => ($opcao == 'ehConjuge'),
            'ehFilhosMenores'   => ($opcao == 'ehFilhosMenores'),
            'ehEmpresa'         => ($opcao == 'ehEmpresa'),
            'ehSindicato'       => ($opcao == 'ehSindicato'),
            'numero_parcelas'   => $request->get('numero_parcelas'),
            'quantidade_kit'    => $request->get('quantidade_kit'),
            'valor'             => toMoney($request->get('valor'))
        ];

        $result = DB::transaction(function() use ($data, $categoria_id, $categoria_beneficio_id) {
            try {

                $data['categoria']->beneficioSociais()->wherePivot('id', $categoria_beneficio_id)
                    ->sync([$data['beneficio_id'] => [
                        'ehTrabalhador'     => $data['ehTrabalhador'],
                        'ehConjuge'         => $data['ehConjuge'],
                        'ehFilhosMenores'   => $data['ehFilhosMenores'],
                        'ehEmpresa'         => $data['ehEmpresa'],
                        'ehSindicato'       => $data['ehSindicato'],
                        'numero_parcelas'   => $data['numero_parcelas'],
                        'quantidade_kit'    => $data['quantidade_kit'],
                        'valor'             => $data['valor'],
                    ]]);

                return redirect()->route('categoria.beneficios.listar', $categoria_id)
                    ->with('msg', 'Benefício atualizado com sucesso!');
            } catch (Throwable $t) {
                return redirect()->route('categoria.beneficios.listar', $categoria_id)
                    ->with('error', "Ocorreu um erro inesperado, tente novamente mais tarde");
            }
        });

        return $result;
    }

    public function pegarOpcaoCadastrada($beneficio)
    {
        if($beneficio->pivot->ehTrabalhador) return 'ehTrabalhador';
        if($beneficio->pivot->ehConjuge) return 'ehConjuge';
        if($beneficio->pivot->ehFilhosMenores) return 'ehFilhosMenores';
        if($beneficio->pivot->ehEmpresa) return 'ehEmpresa';
        return 'ehSindicato';
    }

    // API
    public function pegarCategoria($id) {
        return response()->json(CategoriaSindicato::where('id', $id)->first());
    }


}
