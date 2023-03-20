<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaSindicato extends Model
{
    public function sindicato() {
        return $this->belongsTo(Sindicato::class)->first();
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'valor_beneficio' => $this->valor_beneficio,
        ];
    }

    public function trabalhadores(){
        return $this->hasMany(Trabalhador::class)->get();
    }

    public function beneficioSociais() {
        return $this->belongsToMany(BeneficioSocial::class)
            ->withPivot('id', 'ehTrabalhador', 'ehConjuge', 'ehFilhosMenores', 'ehEmpresa',
                'ehSindicato', 'numero_parcelas', 'quantidade_kit', 'valor');
    }
}
