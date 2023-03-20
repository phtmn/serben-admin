<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTrabalhadorFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome'                  => 'required|min:3|max:150|string',
            'password'              => 'required',
            'cpf'                   => 'required|unique:trabalhadores',
            'rg'                    => 'required|unique:trabalhadores',
            'data_nascimento'       => 'required|date',
            'profissao'             => 'required|max:100|string',
            'email'                 => 'required|unique:trabalhadores',
            'telefone_1'            => 'required|max:50|string',
            'cep'                   => 'required|max:50|string',
            'rua'                   => 'required|max:50|string',
            'bairro'                => 'required|max:100|string',
            'cidade'                => 'required|max:100|string',
            'uf'                    => 'required|max:50|string',
        ];
    }

    public function messages(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'unique'   => 'O campo :attribute informádo ja está em uso',
            'min'      => 'O campo :attribute é muito curto',
            'max'      => 'O campo :attribute é muito longo'                
        ];
    }

    public function attributes(){
        return [                    
            'password'          => 'Senha',
            'data_nascimento'   => 'Data de nascimento',
            'telefone_1'        => 'telefone 1'
        ];
    }
}
