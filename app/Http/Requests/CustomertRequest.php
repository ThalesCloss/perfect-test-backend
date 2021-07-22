<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomertRequest extends FormRequest
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
            'name' => 'required|alpha|min:3',
            'email' => 'email|required',
            'cpf' => 'required|cpf'
        ];
    }
    public function messages()
    {
        return [
            'name' => [
                'required' => 'Informe seu nome',
                'alpha' => 'Informe somente letras para o nome',
                'min' => 'Informe seu nome'
            ],
            'email' => [
                'email' => 'Informe um e-mail válido',
                'Informe seu e-mail'
            ],
            'cpf' => [
                'cpf' => 'O CPF informado é inválido',
                'required' => 'O CPF é obrigatório'
            ]
        ];
    }
}
