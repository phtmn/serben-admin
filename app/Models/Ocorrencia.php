<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ocorrencia extends Model
{
    public function tipoOcorrencia() {
        return $this->belongsTo(TipoOcorrencia::class)->first();
    }

    public function trabalhador() {
        return $this->belongsTo(Trabalhador::class)->first();
    }

    public function detalhamentoTipoOcorrencia() {
        return $this->hasOne(DetalhamentoTipoOcorrencia::class)->first();
    }

    public function beneficioSocial() {
        return $this->belongsTo(BeneficioSocial::class)->first();
    }

    public function statusOcorrencia()
    {
        return $this->belongsTo(StatusOcorrencia::class)->first();
    }

    public function toArray()
    {
        return [
            'responsavel'       => $this->nome_responsavel,
            'departamento'      => $this->departamento,
            'trabalhador'       => $this->trabalhador()->nome,
            'tipo'              => $this->tipoOcorrencia()->nome,
            'beneficio_social'  => $this->beneficioSocial()->nome,
            'valor'             => $this->beneficioSocial()->categoriaSindicatos()->first()->pivot->valor,
            'data'              => date('d/m/Y', strtotime($this->detalhamentoTipoOcorrencia()->data_ocorrencia)),
            'status'            => $this->statusOcorrencia()->nome
        ];
    }
}
