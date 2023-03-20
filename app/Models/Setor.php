<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    protected $table = 'setores';

    public function responsavel() {
        return $this->hasMany(Responsavel::class);
    }
}
