<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmpresaParceiraFormRequest extends FormRequest
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
            'cnpj'                      => 'required|max:30|unique:empresa_parceiras',
            'atividade_empresa'         => 'required|max:100|string',
            'telefone'                  => 'required|max:50|string',

            'cep'                       => 'required|max:50|string',
            'rua'                       => 'required|max:150|string',
            'bairro'                    => 'required|max:100|string',
            'cidade'                    => 'required|max:100|string',
            'uf'                        => 'required|max:50|string',

            'servico'                   => 'required|max:150|string',
            'nome_responsavel'          => 'required|max:150|string',
            'departamento_responsavel'  => 'required|max:150|string',
            'telefone_1_responsavel'    => 'required|max:50|string',
            'email_responsavel'         => 'required|max:50|unique:empresa_parceiras,email_responsavel',
            'password'                  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'unique'   => 'O :attribute informado ja existe em nossa base de dados',
            'max'      => 'O campo :attribute é muito longo'
        ];
    }

    public function attributes(){
        return [
            'atividade_empresa'         => 'atividade da empresa',
            'responsavel_nome'          => 'nome do responsável',
            'departamento_responsavel'  => 'departamento do responsável',
            'telefone_1_responsavel'    => 'telefone 1 do responsável',
            'email_responsavel'         => 'e-email responsável',
            'password'                  => 'senha'
        ];
    }
}
