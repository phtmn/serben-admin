<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
   
    public function painel(){
        return view('site.painel.dashboard');
    }
}
