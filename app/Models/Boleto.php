<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boleto extends Model
{
    
    
    public function empresa(){
        return $this->BelongsTo(Empresa::class);
    }
}
