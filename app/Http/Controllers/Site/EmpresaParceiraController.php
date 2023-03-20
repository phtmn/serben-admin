<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class EmpresaParceiraController extends Controller
{
    public function index(){
        $data = auth()->user()->empresaParceira();
        return view('site.empresa_parceira.perfil',compact('data'));
    }
}
