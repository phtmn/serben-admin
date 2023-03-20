<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dependente extends Model
{
    public function trabalhador() {
        return $this->belongsTo(Trabalhador::class)->first();
    }
}
