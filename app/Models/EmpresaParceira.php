<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpresaParceira extends Model
{
    public function user() {
        return $this->hasOne(User::class);
    }

    public function endereco() {
        return $this->belongsTo(Endereco::class)->first();
    }

    public function TipoServico() {
        return $this->belongsTo(TipoServico::class)->first();
    }

    public function toArray()
    {
        return [
          'id'              => $this->id,
          'razao_social'    => $this->razao_social
        ];
    }
}
