<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    public function user() {
        return $this->hasOne(User::class);
    }
}
