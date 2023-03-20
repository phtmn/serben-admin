<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoParticipanteBeneficio extends Model
{
    protected $table = 'tipo_participante_beneficios';

    public function participanteBeneficioSociais() {
        return $this->hasMany(ParticipanteBeneficioSocial::class)->get();
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome
        ];
    }
}
