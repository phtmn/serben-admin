<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipanteBeneficioSocial extends Model
{
    protected $table = 'participante_beneficio_sociais';

    public function tipoParticipanteBeneficio()
    {
        return $this->belongsTo(TipoParticipanteBeneficio::class)->first();
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class)->first();
    }

    public function banco()
    {
        return $this->belongsTo(Banco::class)->first();
    }

    public function responsavelJuridico()
    {
        return $this->belongsTo(Pessoa::class, 'responsavel_juridico')->first();
    }

    public function presidente()
    {
        return $this->belongsTo(Pessoa::class, 'presidente')->first();
    }

    public function repasses(){
        return $this->hasMany(Repasse::class);
    }

    public function toArray()
    {
        return [
            'id'                            => $this->id,
            'cnpj'                          => $this->cnpj,
            'razao_social'                  => $this->razao_social,
            'tipo_participante_beneficio'   => $this->tipoParticipanteBeneficio(),
        ];
    }
}
