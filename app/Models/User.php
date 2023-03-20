<?php

namespace App\Models;

use App\Enum\PapelEnum;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function papel()
    {
        return $this->belongsTo(Papel::class);
    }

    public function sindicato()
    {
        return $this->belongsTo(Sindicato::class)->first();
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class)->first();
    }

    public function empresaParceira()
    {
        return $this->belongsTo(EmpresaParceira::class)->first();
    }

    public function trabalhador()
    {
        return $this->belongsTo(Trabalhador::class)->first();
    }

    public function isSerben()
    {
        return $this->papel_id == PapelEnum::SERBEN;
    }

    public function isSindicato()
    {
        return $this->papel_id == PapelEnum::SINDICATO;
    }

    public function isEmpresa()
    {
        return $this->papel_id == PapelEnum::EMPRESA;
    }

    public function isEmpresaParceira()
    {
        return $this->papel_id == PapelEnum::EMPRESA_PARCEIRA;
    }

    public function isTrabalhador() {
        return $this->papel_id == PapelEnum::TRABALHADOR;
    }
}