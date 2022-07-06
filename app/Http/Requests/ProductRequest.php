<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|max:255',
            'price' => 'required|numeric|gt:0',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome do produto é obrigatório',
            'name.max' => 'O nome do produto está muito grande',
            'price.required' => 'O preço do produto é obrigatório',
            'price.numeric' => 'O preço deve ser um valor numérico',
            'price.gt' => 'O preço deve ser maior que zero',
            'description.required' => 'A descrição do produto é obrigatória'
        ];
    }
}
