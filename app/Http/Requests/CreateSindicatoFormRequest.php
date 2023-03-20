<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSindicatoFormRequest extends FormRequest
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
            'razao_social'                      => 'required|max:100|string',
            'cnpj'                              => 'required|max:30|unique:sindicatos',
            'email'                             => 'required|max:100|unique:sindicatos',
            'telefone_1'                        => 'required|max:50',
            'banco'                             => 'required|max:100|string',
            'conta'                             => 'required|max:100|string',
            'agencia'                           => 'required|max:100|string',
            'cep'                               => 'required|max:50|string',
            'rua'                               => 'required|max:150|string',
            'bairro'                            => 'required|max:100|string',
            'cidade'                            => 'required|max:100|string',
            'uf'                                => 'required|max:50|string',
            'presidente'                        => 'required|max:150|string',
            'presidente_telefone_1'             => 'required|max:50|string',
            'presidente_email'                  => 'required|max:100|unique:pessoas,email',
            'responsavel_juridico'              => 'required|max:150|string',
            'responsavel_juridico_telefone_1'   => 'required|max:50|string',
            'responsavel_juridico_email'        => 'required|max:100|unique:pessoas,email',
            'responsavel_acesso'                => 'required|max:150|string',
            'responsavel_acesso_telefone_1'     => 'required|max:50|string',
            'responsavel_acesso_email'          => 'required|max:100|unique:pessoas,email',
            'responsavel_acesso_password'       => 'required',
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
            'razao_social'                      => 'razão Social',
            'telefone_1'                        => 'telefone 1',
            'presidente'                        => 'presidente',
            'presidente_telefone_1'             => 'telefone 1 do presidente',
            'presidente_email'                  => 'e-mail do presidente',
            'responsavel_juridico'              => 'responsável Jurídico',
            'responsavel_juridico_telefone_1'   => 'telefone 1 do Responsável Jurídico',
            'responsavel_juridico_email'        => 'e-mail do Responsável Jurídico',
            'responsavel_acesso'                => 'responsável pelo acesso',
            'responsavel_acesso_telefone_1'     => 'telefone 1 do Responsável pelo acesso',
            'responsavel_acesso_email'          => 'e-mail do Responsável pelo acesso',
            'responsavel_acesso_password'       => 'senha do Responsável pelo acesso',

        ];
    }
}
