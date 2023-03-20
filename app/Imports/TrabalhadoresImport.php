<?php

namespace App\Imports;

use App\Trabalhador;
use Maatwebsite\Excel\Concerns\ToModel;

class TrabalhadoresImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Trabalhador([
            'nome'      => $row[0],
            'cpf'       => $row[1],
            'sexo'      => $row[2],
            'email'     => $row[3],
            'telefone'  => $row[4]
        ]);
    }

}
