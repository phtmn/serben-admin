<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contabilidade extends Model
{
    public function responsavel() {
        return $this->belongsTo(Responsavel::class)->first();
    }

    public function endereco() {
        return $this->belongsTo(Endereco::class)->first();
    }
}