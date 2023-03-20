<?php

namespace App\Http\Controllers\Financeiro;

use App\Models\Repasse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RepasseController extends Controller
{
    public function index(){
        $data = Repasse::all();
        return view('admin.financeiro.repasses.index',compact('data'));
    }
}
