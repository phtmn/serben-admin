<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trabalhador extends Model
{
    protected $table = 'trabalhadores';
    protected $dates = ['data_nascimento'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class)->first();
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class)->first();
    }

    public function ocorrencias()
    {
        return $this->hasMany(Ocorrencia::class)->get();
    }

    public function dependentes()
    {
        return $this->hasMany(Dependente::class)->get();
    }

    public function categoriaSindicato()
    {
        return $this->belongsTo(CategoriaSindicato::class)->first();
    }

    public function user()
    {
        return $this->hasOne(User::class)->first();
    }

    public function toArray()
    {
        return [
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'sexo' => $this->sexo,
            'email' => $this->email,
            'telefone_1' => $this->telefone_1,
            'endereco' => $this->endereco()
        ];
    }
}