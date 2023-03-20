<?php

namespace App\Http\Controllers\Site;

use App\Models\CategoriaSindicato;
use App\Models\Cobranca;
use App\Models\Sindicato;
use App\Http\Controllers\Controller;

class SindicatoController extends Controller
{
    public function listarCct(){

        $sindicato = Sindicato::where('id',auth()->user()->sindicato_id)->first();
        $data = CategoriaSindicato::where('sindicato_id',$sindicato->id)->get();

        return view('site.sindicato.cct.index',compact('data'));

    }

    public function empresas(){
        $sindicato_id = auth()->user()->sindicato_id;
        $sindicato  = Sindicato::find($sindicato_id);
        $empresas   = $sindicato->empresas()->pluck('empresa_id','id');

        $data       = Cobranca::whereIn('empresa_id',$empresas)->get();

        return view('site.sindicato.financeiro.index',compact('data'));
    }

    public function listarBeneficios() {
        return view('site.sindicato.beneficios.index', [
            'categorias' => auth()->user()->sindicato()->categoriaSindicatos()
        ]);
    }

}
