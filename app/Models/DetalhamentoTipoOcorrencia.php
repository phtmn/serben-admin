<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalhamentoTipoOcorrencia extends Model
{
    public function tipoOcorrencia() {
        return $this->hasOne(TipoOcorrencia::class);
    }
}
