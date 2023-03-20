<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmpresaFormRequest extends FormRequest
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
            'cnpj'                      => 'required|max:30|unique:empresas',
            'atividade_empresa'         => 'required|max:100|string',
            'cnae'                      => 'required|max:50|string',
            'empresa_telefone_1'        => 'required|max:50|string',
            'email_para_avisos_mensais' => 'required|max:100|unique:empresas,email_avisos_mensais',
            'cep'                       => 'required|max:50|string',
            'rua'                       => 'required|max:150|string',
            'bairro'                    => 'required|max:100|string',
            'cidade'                    => 'required|max:100|string',
            'uf'                        => 'required|max:50|string',
            'responsavel_nome'          => 'required|max:150|string',
            'responsavel_cpf'           => 'required|max:30|string|unique:responsaveis,cpf',
            'responsavel_telefone_1'    => 'required|max:50|string',
            'responsavel_email'         => 'required|max:50|unique:responsaveis,email',
            'responsavel_password'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'unique'   => 'O :attribute informado ja existe em nossa base de dados',
            'min'      => 'O campo :attribute é muito curto',
            'max'      => 'O campo :attribute é muito longo'
        ];
    }

    public function attributes(){
        return [                
            'atividade_empresa'         => 'atividade da empresa',
            'empresa_telefone_1'        => 'telefone 1 da empresa',
            'email_para_avisos_mensais' => 'e-mail para avisos mensais',
            'responsavel_nome'          => 'nome do responsável',
            'responsavel_cpf'           => 'CPF do responsável',
            'responsavel_telefone_1'    => 'telefone 1 do responsável',
            'responsavel_email'         => 'e-mail do responsável',
            'responsavel_password'      => 'senha do responsável'
        ];
    }
}
