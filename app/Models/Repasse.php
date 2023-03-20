<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repasse extends Model
{


    public function cobranca(){
        return $this->belongsTo(Cobranca::class);
    }

    public function participantes(){
        return $this->hasMany(ParticipanteBeneficioSocial::class);
    }

    public function statusPagamento(){
        return $this->belongsTo(StatusPagamento::class)->first();
    }

}
