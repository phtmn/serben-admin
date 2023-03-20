<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBeneficioSocialFormRequest extends FormRequest
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
            'nome'                  => 'required|max:150|string',
            'item'                  => 'required|max:50',
            'descricao'             => 'required',
            'descricao_privada'     => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'max'      => 'O campo :attribute é muito longo'
        ];
    }

    public function attributes(){
        return [
            'descricao'         => 'descrição',
            'descricao_privada' => 'descrição privada'
        ];
    }
}
