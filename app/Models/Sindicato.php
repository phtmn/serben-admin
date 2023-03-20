<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sindicato extends Model
{
    protected $guarded = ['id', 'created_at', 'update_at'];

    public function empresas()
    {
        return $this->belongsToMany(Empresa::class);

    }

    public function categoriaSindicatos()
    {
        return $this->hasMany(CategoriaSindicato::class)->get();
    }

    public function responsavelJuridico()
    {
        return $this->belongsTo(Pessoa::class, 'responsavel_juridico')->first();
    }

    public function presidente()
    {
        return $this->belongsTo(Pessoa::class, 'presidente')->first();
    }

    public function participanteBeneficioSociais()
    {
        return $this->belongsToMany(ParticipanteBeneficioSocial::class)
            ->withPivot('valor_beneficio_social');
    }

    public function empresaParceiras()
    {
        return $this->belongsToMany(EmpresaParceira::class)
            ->withPivot('valor_beneficio_social');
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class)->first();
    }

    public function responsavelAcesso()
    {
        return $this->belongsTo(Pessoa::class,'responsavel_acesso')->first();
    }

    public function banco()
    {
        return $this->belongsTo(Banco::class)->first();
    }
}