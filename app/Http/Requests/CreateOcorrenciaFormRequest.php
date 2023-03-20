<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOcorrenciaFormRequest extends FormRequest
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
            'nome_responsavel'  => 'required|max:150|string',
            'departamento'      => 'required|max:100',
            'data_ocorrencia'   => 'required'
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
            'nome_responsavel'  => 'responsável',
            'data_ocorrencia'   => 'data da ocorrência'
        ];
    }
}
