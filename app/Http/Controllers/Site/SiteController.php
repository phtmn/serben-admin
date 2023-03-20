<?php

namespace App\Http\Controllers\Site;

use App\Models\BeneficioSocial;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function beneficios(){
        $data = BeneficioSocial::all();
        return view('site.paginas.beneficioSocialFamiliar',[
            'data' => $data
        ]);
    }
}
