<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeneficioSocial extends Model
{
    protected $table = 'beneficio_sociais';

    public function tipoOcorrencias()
    {
        return $this->belongsToMany(TipoOcorrencia::class);
    }

    public function categoriaSindicatos() {
        return $this->belongsToMany(CategoriaSindicato::class)
            ->withPivot('id', 'ehTrabalhador', 'ehConjuge', 'ehFilhosMenores', 'ehEmpresa',
                'ehSindicato', 'numero_parcelas', 'quantidade_kit', 'valor');
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome
        ];
    }
}
