<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSaleRequest extends FormRequest
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
            'discount' => 'required|numeric',
            'amount' => 'required|numeric|gt:0',
            'sold_at' => 'required',
            'status' => ['required', Rule::in(['approved', 'canceled', 'returned'])]
        ];
    }
    public function messages()
    {
        return
            [
                'discount.*' => 'O desconto deve ser numérico',
                'amount.*' => 'A quantidade é obrigatória',
                'sold_at.*' => 'A data da compra é obrigatória',
                'status.*' => 'Selecione um status'
            ];
    }
}
