<?php

namespace App\Http\Controllers\Admin;

use App\Models\{Sindicato,Trabalhador,Empresa};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard.index',[
            'trabalhadores' => Trabalhador::all()->count(),
            'sindicatos'     => Sindicato::all()->count(),
            'empresas'      => Empresa::all()->count()
        ]);
    }

    public function painel(){
        return view('admin.painel.dashboard');
    }
}
