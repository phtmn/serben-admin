<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDependenteFormRequest extends FormRequest
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
            'nome'  => 'required|min:3|max:150|string',
            'cpf'   => 'required|max:30|unique:dependentes',
            'idade' => 'required',
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
        return [];
    }
}
