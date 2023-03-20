<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoOcorrencia extends Model
{
    public function ocorrencias() {
        return $this->hasMany(Ocorrencia::class);
    }

}
