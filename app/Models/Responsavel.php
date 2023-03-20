<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responsavel extends Model
{
    protected $table = 'responsaveis';

    public function empresa() {
        return $this->belongsTo(Empresa::class);
    }

    public function setor() {
        return $this->belongsTo(Setor::class)->first();
    }

    public function user() {
        return $this->hasOne(User::class);
    }
}
