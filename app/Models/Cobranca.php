<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cobranca extends Model
{
    
    //protected $dateFormat = 'Y-m-d H:i';
   
    
    public function empresa(){
        return $this->belongsTo(Empresa::class);
    }

    public function repasses(){
        return $this->hasMany(Repasse::class);
    }

//    public function participantes(){
//        return $this->belongsTo(ParticipanteBeneficioSocial::class);
//    }

    public function statusPagamento(){
        return $this->belongsTo(StatusPagamento::class)->first();
    }
}
